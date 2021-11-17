<template>
  <div class="wrapper">
    <h1>もちべった～～</h1>
    <div class="main-wrapper">
      <div class="flex">
        <div class="command">
          <Commands v-on:postGoalData="reflectGoal" v-on:postCharaData="reflectCharacter" v-on:postExpData="reflectExp"></Commands>
        </div>
        <div class="goal">
          <span v-text="this.goal"></span>
          <span v-text="this.number"></span>
          <span v-text="this.unit"></span>
        </div>
        <div class="status">
          <ul>
            <li>
              名前：
              <span v-text="this.name"></span>
            </li>
            <li>
              現在の経験値：
              <span v-text="this.exp"></span>
            </li>
          </ul>
        </div>
      </div>
      <div class="char">
        <MyCanvas :chara_id="this.chara_id"></MyCanvas>
        <!-- （ここにキャラクターが入ります） -->
      </div>
      <div class="message">
        <Message :unit="this.unit" :line="this.chara_line"></Message>
      </div>
    </div>
  </div>
</template>

<script>
import MyCanvas from "./MyCanvas.vue";
import Commands from "./Commands.vue";
import Message from "./Message.vue";

export default {
  components: {
    MyCanvas,
    Commands,
    Message
  },
  data() {
    return {
      goal: null,
      number: null,
      unit: null,
      name: null,
      exp: null,
      chara_id: null,
      chara_line: null,
      foods: null
    };
  },
  mounted() {
    window.axios
      .get("/api/goal/show")
      .then(response => {
        this.reflectGoal(response["data"]);
      })
      .catch(function(error) {
        console.log(error);
      });

    window.axios
      .get("/api/character/show")
      .then(response => {
        this.reflectCharacter(response["data"]);
      })
      .catch(function(error) {
        console.log(error);
      });

    window.axios
      .get("api/game/showPoint")
      .then(response => {
        this.users = response["data"];
        this.$store.state.shopPoint = this.users.point;
      })
      .catch(function(error) {
        console.log(error);
      });

    window.axios
      .get("api/game/showFood")
      .then(response => {
        this.foods = response.data;
      })
      .catch(function(error) {
        console.log(error);
      });
  },
  methods: {
    reflectGoal(goal) {
      this.goal = goal.goal;
      this.number = Number(goal.number);
      this.unit = goal.unit;
    },
    reflectCharacter(chara) {
      this.name = chara.character_template.name;
      this.exp = chara.exp;
      this.chara_id = chara.character_template.id;
      this.chara_line = chara.character_template.line;
    },
    reflectExp(exp){
      this.exp = exp;
    }
  }
};
</script>