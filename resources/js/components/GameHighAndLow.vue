<template>
  <div class="message-game">
    <h3>▼ ハイ&amp;ロー 現在{{ this.point }}ポイント</h3>

    <div class="game-index game-index-highAndLow">
      <div class="coin">
        <span>現在の賭けポイント:</span>
        <span id="point_highAndLow">0</span>
      </div>
      <div class="select-item">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">start</span>

        <p id="number_highAndLow">最大値は13です。次の数値の大小を予測してください。</p>
      <div class="select-item-hl">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">high</span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">low</span>
      </div>
      <div class="select-item-rf">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">reset</span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 4}">finish</span>
      </div>
      </div>
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