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
export default {
  created: function() {},
  mounted: function() {
    addEventListener("keyup", this.selectCommand);
  },
  methods: {
    selectCommand(e) {
      //下
      if (e.keyCode === 40) {
        this.isMovableMainCursor()
          ? this.$store.commit("incrementMainCursor")
          : this.$store.commit("incrementSubCursor", this.getSubCursorLimit());
      }
      // 上
      if (e.keyCode === 38) {
        this.isMovableMainCursor()
          ? this.$store.commit("decrementMainCursor")
          : this.$store.commit("decrementSubCursor");
      }
      // スペース　決定
      if (e.keyCode === 32) {
        this.isInputFocus();
        this.$store.state.isInputMode === this.isInputMode();
        console.log(this.isInputMode());
        this.$store.commit("setScreenId", this.getNextScreenId());
      }
      // ESC　戻る
      if (e.keyCode === 27 && this.$store.state.isInputMode === false) {
        this.$store.state.selectedSubCursor = 0;
        document.activeElement.blur();
        this.$store.commit("setScreenId", this.getPrevScreenId());
      }
    },
    getNextScreenId() {
      if (this.$store.state.screenId === 0) {
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
    isInputFocus() {
      if (this.$store.state.isInputMode) {
        if (this.$store.state.screenId === 1) {
          if (this.$store.state.selectedSubCursor === 0) {
            // document.getElementById("goal").focus();
            return;
          }
          if (this.$store.state.selectedSubCursor === 1) {
            // document.getElementById("number").focus();
            return;
          }
          if (this.$store.state.selectedSubCursor === 2) {
            // document.getElementById("unit").focus();
            return;
          }
        }
        if (this.$store.state.screenId === 2) {
          if (this.$store.state.selectedSubCursor === 0) {
            // document.getElementById("achieve").focus();
            return;
          }
        }
      }
    }
  }
};
</script>