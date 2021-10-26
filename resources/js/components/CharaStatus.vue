<template>
  <div class="message-chara">
    <h3>▼ キャラクターステータス</h3>

    <div class="chara-index">
      <div class="chara-index-first">
        <span>現在経験値: {{ this.$store.state.characters.exp }}</span>
        <span>好感度: {{ this.$store.state.characters.love}}</span>
      </div>
      <div class="chara-index-second">
        <span>必要経験値: 0</span>
        <span>成長度: {{ this.$store.state.characters.growth }}</span>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
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