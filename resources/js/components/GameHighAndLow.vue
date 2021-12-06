<template>
  <div class="message-game">
    <h3>▼ ハイ&amp;ロー 現在{{ this.point }}ポイント</h3>

    <div class="game-index">
      <div class="coin-wrapper flex">
        <p id="point">0</p>
      </div>
      <div class="start-button button-wrapper">
        <input type="button" value="start" id="start" />
      </div>

      <div class="number-wrapper">
        <p id="number">ここに数値が出ます</p>
      </div>

      <div class="play-button button-wrapper">
        <input type="button" value="high" id="high" />
        <input type="button" value="low" id="low" />
      </div>

      <div class="reset-button button-wrapper">
        <input type="button" value="reset" id="reset" />
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