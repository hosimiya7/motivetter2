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
import { MainCursor } from "../Cursor";
import { SubCursor } from "../Cursor";

export default {
  created: function() {
    this.mainCursor = new MainCursor();
  },
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  data() {
    return {};
  },
  methods: {
    selectCommand(e) {
      const keyHandler = new KeyHandler(e.keyCode);
      const subCursor = new SubCursor();

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
          this.$store.state.selectedSubCursor = subCursor.INDENT1;
        }
      }
      // ESC　戻る
      if (keyHandler.isKeyEsc()) {
        if (!this.$store.state.isInputMode) {
          this.$store.commit("setScreenId", this.getPrevScreenId());
          this.$store.state.selectedSubCursor = subCursor.INDENT1;
        }
        if (this.$store.state.isInputMode) {
          document.activeElement.blur();
          this.$store.state.isInputMode = false;
        }
      }
    },
    getNextScreenId() {
      const screen = new Screen();
      const subCursor = new SubCursor();

      if (this.$store.state.screenId === screen.FIRST) {
        if (this.getIsGoal()) {
          return screen.GOAL;
        }
        if (this.getIsAchieve()) {
          return screen.ACHIEVE;
        }
        if (this.getIsCharacter()) {
          return screen.CHARACTER;
        }
        if (this.getIsGame()) {
          return screen.GAME;
        }
      }
      if (this.$store.state.screenId === screen.CHARACTER) {
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          return screen.CHARACTER_STATUS;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT2) {
          return screen.CHARACTER_FOOD;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT3) {
          return screen.CHARACTER_PICTURES;
        }
        if (this.$store.state.selectedSubCursor === subCursor.INDENT4) {
          return screen.CHARACTER_FAREWELL;
        }
      }
      return this.$store.state.screenId;
    },
    getPrevScreenId() {
      const screen = new Screen();

      if (this.$store.state.screenId === screen.FIRST) {
        return screen.FIRST;
      }
      if (this.$store.state.screenId === screen.GOAL) {
        return screen.FIRST;
      }
      if (this.$store.state.screenId === screen.ACHIEVE) {
        return screen.FIRST;
      }
      if (this.$store.state.screenId === screen.CHARACTER) {
        return screen.FIRST;
      }
      if (this.$store.state.screenId === screen.GAME) {
        return screen.FIRST;
      }
      if (this.$store.state.screenId === screen.CHARACTER_STATUS) {
        return screen.CHARACTER;
      }
      if (this.$store.state.screenId === screen.CHARACTER_FOOD) {
        return screen.CHARACTER;
      }
      if (this.$store.state.screenId === screen.CHARACTER_PICTURES) {
        return screen.CHARACTER;
      }
      if (this.$store.state.screenId === screen.CHARACTER_FAREWELL) {
        return screen.CHARACTER;
      }
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
      if (this.$store.state.screenId === screen.CHARACTER_FAREWELL) {
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
        if (this.$store.state.selectedSubCursor === subCursor.INDENT1) {
          return true;
        }
      }
      return false;
    },
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
      const subCursor = new SubCursor();
      if (
        this.$store.state.selectedMainCursor === this.mainCursor.GOAL &&
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
        this.$store.state.selectedMainCursor === this.mainCursor.ACHIEVE &&
        this.$store.state.selectedSubCursor === subCursor.INDENT2
      ) {
        console.log("今後値が入力できるようにする");
      }
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