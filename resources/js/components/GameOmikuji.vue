<template>
  <div class="message-game">
    <h3>▼ おみくじ 現在{{ this.point }}ポイント</h3>
    <div class="game-index omikuji">
      <div id="main" class="main">
        <div id="selected">今日の運勢は…？</div>
      </div>
      <div class="start">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">はじめる</span>
      </div>
      <div class="stop">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">とめる</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["point"],
  created: function() {
  },
  mounted: function() {},
  data() {
    return {};
  },
  methods: {}
};
</script>