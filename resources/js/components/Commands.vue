<template>
  <div class="commands">
    <div class="command" v-bind:class="{ active: getIsGoal() }">目標入力・変更</div>
    <div class="command" v-bind:class="{ active: getIsAchieve() }">達成入力</div>
    <div class="command" v-bind:class="{ active: getIsCharacter() }">キャラクター管理</div>
    <div class="command" v-bind:class="{ active: getIsGame() }">ミニゲーム</div>
  </div>
</template>

<script>
import KeyHandler from "../KeyHandler";
import Screen from "../Screen";
import Omikuji from "../Omikuji";
import HighAndLow from "../HighAndLow";
import { MainCursor } from "../Cursor";
import { SubCursor } from "../Cursor";

export default {
  props: ["foods"],
  created: function() {
    this.mainCursor = new MainCursor();
    this.subCursor = new SubCursor();
    this.screen = new Screen();
    this.omikuji = new Omikuji();
    this.highAndLow = new HighAndLow();
  },
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  data() {
    return {
      users: [],
      newExp: null,
      point: null,
      food: null
    };
  },
  methods: {
    selectCommand(e) {
      const keyHandler = new KeyHandler(e.keyCode);

      //下
      if (keyHandler.isKeyDown() && !this.$store.state.isInputMode) {
        this.isMovableMainCursor()
          ? this.$store.commit("incrementMainCursor")
          : this.$store.commit("incrementSubCursor", this.getSubCursorLimit());
      }
      // 上
      if (keyHandler.isKeyUp() && !this.$store.state.isInputMode) {
        this.isMovableMainCursor()
          ? this.$store.commit("decrementMainCursor")
          : this.$store.commit("decrementSubCursor");
      }
      // スペース　決定
      if (keyHandler.isKeySpace()) {
        this.$store.state.isInputMode = this.isInputMode();
        this.setFocus();
        if (!this.$store.state.isInputMode) {
          this.postGoalData();
          this.getExp();
          this.farewellCharacter();
          this.playOmikuji();
          this.postFoodId();
          this.postCharacterFood();
          this.playHighAndLow();
          this.$store.commit("setScreenId", this.getNextScreenId());
          this.$store.state.selectedSubCursor = this.subCursor.INDENT1;
        }
      }
      // ESC　戻る
      if (keyHandler.isKeyEsc()) {
        if (!this.$store.state.isInputMode) {
          this.$store.commit("setScreenId", this.getPrevScreenId());
          this.$store.state.selectedSubCursor = this.subCursor.INDENT1;
        }
        if (this.$store.state.isInputMode) {
          document.activeElement.blur();
          this.$store.state.isInputMode = false;
        }
      }
    },
    getNextScreenId() {
      if (this.$store.state.screenId === this.screen.FIRST) {
        if (this.getIsGoal()) {
          return this.screen.GOAL;
        }
        if (this.getIsAchieve()) {
          return this.screen.ACHIEVE;
        }
        if (this.getIsCharacter()) {
          return this.screen.CHARACTER;
        }
        if (this.getIsGame()) {
          return this.screen.GAME;
        }
      }
      if (this.$store.state.screenId === this.screen.CHARACTER) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          return this.screen.CHARACTER_STATUS;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          return this.screen.CHARACTER_FOOD;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          return this.screen.CHARACTER_PICTURES;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
          return this.screen.CHARACTER_FAREWELL;
        }
      }
      if (this.$store.state.screenId === this.screen.GAME) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          return this.screen.GAMESLOT;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          return this.screen.GAMEHIGHANDLOW;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          return this.screen.GAMEOMIKUJI;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
          return this.screen.GAMEFOODSHOP;
        }
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FAREWELL) {
        return this.screen.FIRST;
      }
      return this.$store.state.screenId;
    },
    getPrevScreenId() {
      if (this.$store.state.screenId === this.screen.FIRST) {
        return this.screen.FIRST;
      }
      if (this.$store.state.screenId === this.screen.GOAL) {
        return this.screen.FIRST;
      }
      if (this.$store.state.screenId === this.screen.ACHIEVE) {
        return this.screen.FIRST;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER) {
        return this.screen.FIRST;
      }
      if (this.$store.state.screenId === this.screen.GAME) {
        return this.screen.FIRST;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_STATUS) {
        return this.screen.CHARACTER;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FOOD) {
        return this.screen.CHARACTER;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_PICTURES) {
        return this.screen.CHARACTER;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FAREWELL) {
        return this.screen.CHARACTER;
      }
      if (this.$store.state.screenId === this.screen.GAMESLOT) {
        return this.screen.GAME;
      }
      if (this.$store.state.screenId === this.screen.GAMEHIGHANDLOW) {
        return this.screen.GAME;
      }
      if (this.$store.state.screenId === this.screen.GAMEOMIKUJI) {
        return this.screen.GAME;
      }
      if (this.$store.state.screenId === this.screen.GAMEFOODSHOP) {
        return this.screen.GAME;
      }
    },
    isMovableMainCursor() {
      return this.$store.state.screenId === this.screen.FIRST;
    },
    getSubCursorLimit() {
      if (this.$store.state.screenId === this.screen.ACHIEVE) {
        return 1;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FOOD) {
        return 4;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FAREWELL) {
        return 1;
      }
      if (this.$store.state.screenId === this.screen.GAMEOMIKUJI) {
        return 1;
      }
      if (this.$store.state.screenId === this.screen.GAMEHIGHANDLOW) {
        return 4;
      }
      return 3;
    },
    isInputMode() {
      if (this.$store.state.screenId === this.screen.GOAL) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          return true;
        }
      }
      if (this.$store.state.screenId === this.screen.ACHIEVE) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          return true;
        }
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FOOD) {
        if (
          this.$store.state.selectedSubCursor === this.subCursor.INDENT1 &&
          this.foods[0].quantity > 0
        ) {
          return true;
        }
        if (
          this.$store.state.selectedSubCursor === this.subCursor.INDENT2 &&
          this.foods[1].quantity > 0
        ) {
          return true;
        }
        if (
          this.$store.state.selectedSubCursor === this.subCursor.INDENT3 &&
          this.foods[2].quantity > 0
        ) {
          return true;
        }
        if (
          this.$store.state.selectedSubCursor === this.subCursor.INDENT4 &&
          this.foods[3].quantity > 0
        ) {
          return true;
        }
      }
      return false;
    },
    setFocus() {
      if (!this.isInputMode()) {
        return;
      }
      if (this.$store.state.screenId === this.screen.GOAL) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          document.getElementById("goal").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          document.getElementById("number").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          document.getElementById("unit").focus();
          return;
        }
      }
      if (this.$store.state.screenId === this.screen.ACHIEVE) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          document.getElementById("achieve").focus();
          return;
        }
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FOOD) {
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          document.getElementById("food_1").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          document.getElementById("food_2").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          document.getElementById("food_3").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
          document.getElementById("food_4").focus();
          return;
        }
      }
    },
    postGoalData() {
      if (
        this.$store.state.selectedMainCursor === this.mainCursor.GOAL &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT4
      ) {
        // 登録・if文で要素が入っていたら送る。それ以外はエラーを出す
        const postData = {
          goal: document.getElementById("goal").value,
          number: document.getElementById("number").value,
          unit: document.getElementById("unit").value
        };
        window.axios
          .post("api/goal/create", postData)
          .then(function(response) {
            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
        this.$emit("postGoalData", postData);
      }
    },
    getExp() {
      if (
        this.$store.state.selectedMainCursor === this.mainCursor.ACHIEVE &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT2
      ) {
        window.axios
          .post("api/character/updateExp", {
            achieve: document.getElementById("achieve").value
          })
          .then(
            function(response) {
              let character = response.data;
              this.$emit("postCharaData", character);
            }.bind(this)
          )
          .catch(
            function(error) {
              console.log(error);
            }.bind(this)
          );
      }
    },
    farewellCharacter() {
      if (
        this.$store.state.screenId === this.screen.CHARACTER_FAREWELL &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT1
      ) {
        const postData = {
          character_template: {
            id: 1,
            name: "もっち～",
            line: "ごはんまだ～？？"
          },
          exp: 0
        };
        window.axios
          .post("api/character/delete")
          .then(function(response) {
            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
        this.$emit("postCharaData", postData);
      }
    },
    async postCharacterFood() {
      if (
        this.$store.state.screenId === this.screen.CHARACTER_FOOD &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT5
      ) {
        await window.axios
          .post("api/character/food", {
            food_1: document.getElementById("food_1").value,
            food_2: document.getElementById("food_2").value,
            food_3: document.getElementById("food_3").value,
            food_4: document.getElementById("food_4").value
          })
          .then(
            function(response) {
              this.food = response["data"];
              this.$emit("postFoodData", this.food);
            }.bind(this)
          )
          .catch(
            function(error) {
              console.log(error);
            }.bind(this)
          );
      }
    },
    playOmikuji() {
      if (
        this.$store.state.screenId === this.screen.GAMEOMIKUJI &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT1
      ) {
        this.omikuji.startOmikuji();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEOMIKUJI &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT2
      ) {
        this.omikuji.stopOmikuji();
        this.postShopPoint(this.omikuji.omikujiShopPoint());
      }
    },
    // startのできる状態かをif文に追加する。isPlayingGame()を使いたい
    playHighAndLow() {
      if (
        this.$store.state.screenId === this.screen.GAME &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT2
      ) {
        this.highAndLow.setGame();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEHIGHANDLOW &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT1
      ) {
        this.highAndLow.startGame();
        this.payHighAndLowpoint();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEHIGHANDLOW &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT2
      ) {
        if (this.highAndLow.randomNum <= this.highAndLow.nextNum) {
          this.highAndLow.getPoint();
          // this.$store.state.selectedSubCursor = this.subCursor.INDENT2
        } else {
          this.highAndLow.lostPoint();
          // this.$store.state.selectedSubCursor = this.subCursor.INDENT4
        }
        this.highAndLow.playGame();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEHIGHANDLOW &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT3
      ) {
        if (this.highAndLow.randomNum >= this.highAndLow.nextNum) {
          this.highAndLow.getPoint();
          // this.$store.state.selectedSubCursor = this.subCursor.INDENT2
        } else {
          this.highAndLow.lostPoint();
          // this.$store.state.selectedSubCursor = this.subCursor.INDENT4
        }
        this.highAndLow.playGame();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEHIGHANDLOW &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT4
      ) {
        this.highAndLow.resetGame();
      }
      if (
        this.$store.state.screenId === this.screen.GAMEHIGHANDLOW &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT5
      ) {
        this.postHighAndLowPoint();
        this.highAndLow.resetGame();
      }
    },
    escHighAndLow() {
      if (this.$store.state.screenId === this.screen.GAMEHIGHANDLOW) {
        this.highAndLow.resetGame();
      }
    },
    payHighAndLowpoint() {
      window.axios
        .post("api/game/payHighAndLowPoint")
        .then(
          function(response) {
            this.point = response["data"];
            this.$emit("postPointData", this.point);
          }.bind(this)
        )
        .catch(
          function(error) {
            console.log(error);
          }.bind(this)
        );
    },
    postHighAndLowPoint() {
      window.axios
        .post("api/game/postHighAndLowPoint", {
          point: this.highAndLow.point
        })
        .then(
          function(response) {
            console.log(response);
            this.point = response["data"];
            this.$emit("postPointData", this.point);
          }.bind(this)
        )
        .catch(
          function(error) {
            console.log(error);
          }.bind(this)
        );
    },
    postShopPoint(point) {
      window.axios
        .post("api/game/postPoint", {
          point: this.getNewShopPoint(point)
        })
        .then(
          function(response) {
            this.point = response["data"];
            this.$emit("postPointData", this.point);
          }.bind(this)
        )
        .catch(
          function(error) {
            console.log(error);
          }.bind(this)
        );
    },
    postFoodId() {
      if (this.$store.state.screenId === this.screen.GAMEFOODSHOP) {
        window.axios
          .post("api/game/postFood", {
            foodId: this.setFoodId()
          })
          .then(
            function(response) {
              this.point = response["data"][1].point;
              this.$emit("postPointData", this.point);
              this.food = response["data"][0];
              this.$emit("postFoodData", this.food);
            }.bind(this)
          )
          .catch(
            function(error) {
              console.log(error);
            }.bind(this)
          );
      }
    },
    setFoodId() {
      if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
        return 1;
      }
      if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
        return 2;
      }
      if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
        return 3;
      }
      if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
        return 4;
      }
    },
    getNewShopPoint(point) {
      return point;
    },
    getIsGoal() {
      return this.$store.state.selectedMainCursor === this.mainCursor.GOAL;
    },
    getIsAchieve() {
      return this.$store.state.selectedMainCursor === this.mainCursor.ACHIEVE;
    },
    getIsCharacter() {
      return this.$store.state.selectedMainCursor === this.mainCursor.CHARACTER;
    },
    getIsGame() {
      return this.$store.state.selectedMainCursor === this.mainCursor.GAME;
    }
  }
};
</script>