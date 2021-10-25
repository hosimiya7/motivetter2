<template>
  <div class="wrapper">
    <h1>もちべった～～</h1>
    <div class="main-wrapper">
      <div class="flex">
        <div class="command">
          <Commands></Commands>
        </div>
        <div class="goal">
          <span v-text="this.$store.state.goals.number"></span>
          <span v-text="this.$store.state.goals.unit"></span>
          <span v-text="this.$store.state.goals.goal"></span>
        </div>
        <div class="status">
          <ul>
            <li>名前：{{ this.$store.state.characters.character_template.name }}</li>
            <li>現在の経験値：{{ this.$store.state.characters.exp }}</li>
          </ul>
        </div>
      </div>
      <div class="char">
        <MyCanvas></MyCanvas>
        <!-- （ここにキャラクターが入ります） -->
      </div>
      <div class="message">
        <Message></Message>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import MyCanvas from "./MyCanvas.vue";
import Commands from "./Commands.vue";
export default {
  components: {
    MyCanvas,
    Commands
  },
  data() {
    return {
      characters: []
    };
  },
  mounted() {
    window.axios
      .get("/api/goal/show")
      .then(response => {
        this.$store.state.goals = response["data"];
      })
      .catch(function(error) {
        console.log(error);
      });

    window.axios
      .get("/api/character/show")
      .then(response => {
        this.$store.state.characters = response["data"];
      })
      .catch(function(error) {
        console.log(error);
      });

    window.axios
      .get("api/game/showPoint")
      .then(response => {
        this.users = response["data"];
        this.$store.state.shopPoint = this.users.point;
        console.log(this.$store.state.shopPoint);
      })
      .catch(function(error) {
        console.log(error);
      });
  }
};
</script>