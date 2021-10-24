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
import { MainCursor } from "../Cursor";
import { SubCursor } from "../Cursor";

export default {
  created: function() {
    this.mainCursor = new MainCursor();
    this.subCursor = new SubCursor();
    this.screen = new Screen();
    this.omikuji = new Omikuji();
  },
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  data() {
    return {
      goals: [],
      characters: [],
      gotExp: 0
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
          this.postData();
          this.getExp();
          this.farewellCharacter();
          this.playOmikuji()
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
        return 5;
      }
      if (this.$store.state.screenId === this.screen.CHARACTER_FAREWELL) {
        return 1;
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
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT1) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
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
          document.getElementById("strawberry").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT2) {
          document.getElementById("mochi").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT3) {
          document.getElementById("melon").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === this.subCursor.INDENT4) {
          document.getElementById("grass").focus();
          return;
        }
      }
    },
    postData() {
      if (
        this.$store.state.selectedMainCursor === this.mainCursor.GOAL &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT4
      ) {
        // 登録・if文で要素が入っていたら送る。それ以外はエラーを出す
        window.axios
          .post("api/goal/create", {
            goal: document.getElementById("goal").value,
            number: document.getElementById("number").value,
            unit: document.getElementById("unit").value
          })
          .then(function(response) {
            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
        window.axios
          .get("/api/goal/show")
          .then(response => {
            this.$store.state.goals = response["data"];
          })
          .catch(function(error) {
            console.log(error);
          });
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
          .then(function(response) {
            console.log(response);
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
      }
    },
    farewellCharacter() {
      if (
        this.$store.state.screenId === this.screen.CHARACTER_FAREWELL &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT1
      ) {
        window.axios
          .post("api/character/delete")
          .then(function(response) {
            console.log(response);
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
      }
    },
    playOmikuji() {
       if (
        this.$store.state.screenId === this.screen.GAMEOMIKUJI &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT1
      ) {
        this.omikuji.startOmikuji()
      }
      if (
        this.$store.state.screenId === this.screen.GAMEOMIKUJI &&
        this.$store.state.selectedSubCursor === this.subCursor.INDENT2
      ) {
        this.omikuji.stopOmikuji()
        this.$store.state.shopPoint = this.omikuji.omikujiShopPoint()
        this.postShopPoint()
      }
    },
    postShopPoint() {
      window.axios
          .post("api/game/postOmikujiPoint")
          .then(function(response) {
            point: this.$store.state.shopPoint;
            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
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