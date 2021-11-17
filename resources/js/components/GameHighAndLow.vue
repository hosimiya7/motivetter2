<template>
  <div class="message-game">
    <h3>▼ ハイ&amp;ロー 現在{{ this.point }}ポイント</h3>

    <div class="game-index">
      <p>準備中</p>
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