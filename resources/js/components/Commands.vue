<template>
  <div class="commands">
    <div class="command" v-bind:class="{active: this.$store.state.selectedMainCursor === 1}">目標入力・変更</div>
    <div class="command" v-bind:class="{active: this.$store.state.selectedMainCursor === 2}">達成入力</div>
    <div
      class="command"
      v-bind:class="{active: this.$store.state.selectedMainCursor === 3}"
    >キャラクター管理</div>
    <div class="command" v-bind:class="{active: this.$store.state.selectedMainCursor === 4}">ミニゲーム</div>
  </div>
</template>

<script>
import KeyHandler from "../KeyHandler";
import Screen from "../Screen";
import { MainCursor } from "../Cursor";
import { SubCursor } from "../Cursor";

export default {
  created: function() {},
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  data() {
    return {};
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
          this.$store.commit("setScreenId", this.getNextScreenId());
        }
      }
      // ESC　戻る
      if (keyHandler.isKeyEsc()) {
        if (!this.$store.state.isInputMode) {
          this.$store.state.selectedSubCursor = 0;
          this.$store.commit("setScreenId", this.getPrevScreenId());
        }
        if (this.$store.state.isInputMode) {
          document.activeElement.blur();
          this.$store.state.isInputMode = false;
        }
      }
    },
    getNextScreenId() {
      const screen = new Screen();
      const mainCursor = new MainCursor();
      const subCursor = new SubCursor();

      if (this.$store.state.screenId === screen.FIRST) {
        if (this.$store.state.selectedMainCursor === mainCursor.GOAL) {
          return 1;
        }
        if (this.$store.state.selectedMainCursor === mainCursor.ACHIEVE) {
          return 2;
        }
        if (this.$store.state.selectedMainCursor === mainCursor.CHARACTER) {
          return 3;
        }
        if (this.$store.state.selectedMainCursor === mainCursor.GAME) {
          return 4;
        }
      }
      if (this.$store.state.screenId === screen.CHARACTER) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          return 5;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT2) {
          return 6;
        }
        // if (this.$store.state.selectedSubCursor === 2) {
        //   return 7;
        // }
        // if (this.$store.state.selectedSubCursor === 3) {
        //   return 8;
        // }
      }
      return this.$store.state.screenId;
    },
    getPrevScreenId() {
      const screen = new Screen();

      if (this.$store.state.screenId === screen.FIRST) {
        return 0;
      }
      if (this.$store.state.screenId === screen.GOAL) {
        return 0;
      }
      if (this.$store.state.screenId === screen.ACHIEVE) {
        return 0;
      }
      if (this.$store.state.screenId === screen.CHARACTER) {
        return 0;
      }
      if (this.$store.state.screenId === screen.GAME) {
        return 0;
      }
      if (this.$store.state.screenId === screen.CHARACTERSTATUS) {
        return 3;
      }
      if (this.$store.state.screenId === screen.CHARACTERFOOD) {
        return 3;
      }
      // if (this.$store.state.screenId === 7) {
      //   return 3;
      // }
      // if (this.$store.state.screenId === 8) {
      //   return 3;
      // }
    },
    isMovableMainCursor() {
      const screen = new Screen();
      return this.$store.state.screenId === screen.FIRST;
    },
    getSubCursorLimit() {
      const screen = new Screen();
      if (this.$store.state.screenId === screen.ACHIEVE) {
        return 1;
      }
      return 3;
    },
    isInputMode() {
      const screen = new Screen();
      const subCursor = new SubCursor();

      if (this.$store.state.screenId === screen.GOAL) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT2) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT3) {
          return true;
        }
      }
      if (this.$store.state.screenId === screen.ACHIEVE) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT4) {
          return true;
        }
      }
      return false;
    },
    isNotInputMode() {},
    setFocus() {
      const screen = new Screen();
      const subCursor = new SubCursor();
      if (!this.isInputMode()) {
        return;
      }
      if (this.$store.state.screenId === screen.GOAL) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          document.getElementById("goal").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT2) {
          document.getElementById("number").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT3) {
          document.getElementById("unit").focus();
          return;
        }
      }
      if (this.$store.state.screenId === screen.ACHIEVE) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          document.getElementById("achieve").focus();
          return;
        }
      }
    },
    postData() {
      const mainCursor = new MainCursor();
      const subCursor = new SubCursor();
      if (
        this.$store.state.selectedMainCursor === mainCursor.GOAL &&
        this.$store.state.selectedSubCursor === subCursor.INDENT4
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
      }
      if (
        this.$store.state.selectedMainCursor === mainCursor.ACHIEVE &&
        this.$store.state.selectedSubCursor === subCursor.INDENT2
      ) {
        console.log("今後値が入力できるようにする");
      }
    },
    isMainCursorGoal() {
      const mainCursor = new MainCursor();
      this.$store.state.selectedMainCursor === mainCursor.GOAL;
    },
    isMainCursorAchieve() {
      const mainCursor = new MainCursor();
      this.$store.state.selectedMainCursor === mainCursor.ACHIEVE;
    },
    isMainCursorCharacter() {
      const mainCursor = new MainCursor();
      this.$store.state.selectedMainCursor === mainCursor.CHARACTER;
    },
    isMainCursorGame() {
      const mainCursor = new MainCursor();
      this.$store.state.selectedMainCursor === mainCursor.GAME;
    }
  }
};
</script>