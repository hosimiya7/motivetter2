<template>
  <div class="message-game">
    <h3>▼ おみくじ 現在{{ this.$store.state.shopPoint }}ポイント</h3>
    <div class="game-index omikuji">
      <div id="main" class="main">
        <div id="selected">今日の運勢は…？</div>
      </div>
      <div class="start">
        <button v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">はじめる</button>
      </div>
      <div class="stop">
        <button v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">とめる</button>
      </div>
    </div>
  </div>
</template>

<script>
import Omikuji from "../Omikuji";
export default {
  created: function() {
    this.omikuji = new Omikuji();
  },
  mounted: function() {},
  data() {
    return {};
  },
  methods: {}
};
</script>