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
import KeyHandler from "../KeyHandler"
import Screen from "../Screen"

export default {
  created: function() {},
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  data() {
    return {
    };
  },
  methods: {
    selectCommand(e) {
      const keyHandler = new KeyHandler(e.keyCode)

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

      const screen = new Screen()

      if (this.$store.state.screenId === screen.FIRST) {
        if (this.$store.state.selectedMainCursor === 1) {
          return 1;
        }
        if (this.$store.state.selectedMainCursor === 2) {
          return 2;
        }
        if (this.$store.state.selectedMainCursor === 3) {
          return 3;
        }
        if (this.$store.state.selectedMainCursor === 4) {
          return 4;
        }
      }
      if (this.$store.state.screenId === 3) {
        if (this.$store.state.selectedSubCursor === 0) {
          return 5;
        }
        if (this.$store.state.selectedSubCursor === 1) {
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
      if (this.$store.state.screenId === 0) {
        return 0;
      }
      if (this.$store.state.screenId === 1) {
        return 0;
      }
      if (this.$store.state.screenId === 2) {
        return 0;
      }
      if (this.$store.state.screenId === 3) {
        return 0;
      }
      if (this.$store.state.screenId === 4) {
        return 0;
      }
      if (this.$store.state.screenId === 5) {
        return 3;
      }
      if (this.$store.state.screenId === 6) {
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
      return this.$store.state.screenId === 0;
    },
    getSubCursorLimit() {
      if (this.$store.state.screenId === 2) {
        return 1;
      }
      return 3;
    },
    isInputMode() {
      if (this.$store.state.screenId === 1) {
        if (this.$store.state.selectedSubCursor === 0) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === 1) {
          return true;
        }
        if (this.$store.state.selectedSubCursor === 2) {
          return true;
        }
      }
      if (this.$store.state.screenId === 2) {
        if (this.$store.state.selectedSubCursor === 0) {
          return true;
        }
      }
      return false;
    },
    isNotInputMode(){

    },
    setFocus() {
      if (!this.isInputMode()) {
        return;
      }
      if (this.$store.state.screenId === 1) {
        if (this.$store.state.selectedSubCursor === 0) {
          document.getElementById("goal").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === 1) {
          document.getElementById("number").focus();
          return;
        }
        if (this.$store.state.selectedSubCursor === 2) {
          document.getElementById("unit").focus();
          return;
        }
      }
      if (this.$store.state.screenId === 2) {
        if (this.$store.state.selectedSubCursor === 0) {
          document.getElementById("achieve").focus();
          return;
        }
      }
    },
    postData() {
      if (
        this.$store.state.selectedMainCursor === 1 &&
        this.$store.state.selectedSubCursor === 3
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
      if(this.$store.state.selectedMainCursor === 2 &&
        this.$store.state.selectedSubCursor === 1){
          console.log("今後値が入力できるようにする")
        }
    }
  },
};
</script>