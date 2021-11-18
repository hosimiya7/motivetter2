<template>
  <div class="message-chara">
    <h3>▼ キャラクターステータス</h3>

    <div class="chara-index">
      <div class="chara-index-first">
        <span>現在経験値: {{ this.exp }}</span>
        <span>好感度: {{ this.love}}</span>
      </div>
      <div class="chara-index-second">
        <span>必要経験値: 0</span>
        <span>成長度: {{ this.growth }}</span>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  props: ["exp", "love", "growth"],
  created: function() {},
  data() {
    return {
      characters: []
    };
  },
  mounted() {

  },
  methods: {
  }
};
</script>