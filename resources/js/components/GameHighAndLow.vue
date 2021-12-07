<template>
  <div class="message-game">
    <h3>▼ ハイ&amp;ロー 現在{{ this.point }}ポイント</h3>

    <div class="game-index">
      <span id="point_highAndLow">0</span>
      <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">start</span>

      <p id="number_highAndLow">ここに数値が出ます</p>

      <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">high</span>
      <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">low</span>

      <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">reset</span>
    </div>
  </div>
</template>
<script>
export default {
  props: ["point"],
  created: function() {},
  data() {
    return {};
  },
  methods: {}
};
</script>