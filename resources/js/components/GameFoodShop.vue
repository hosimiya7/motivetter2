<template>
  <div class="message-game">
    <h3>▼ えさ販売店 現在{{ this.$store.state.shopPoint }}ポイント</h3>

    <div class="game-index">
      <div class="game-index-first">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">
          いちご
          <span class="margin-none" v-text="">0</span>個
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">
          おもち
          <span class="margin-none" v-text="">0</span>個
        </span>
      </div>
      <div class="game-index-second">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">
          めろん
          <span class="margin-none" v-text="">0</span>個
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">
          はっぱ
          <span class="margin-none" v-text="">0</span>個
        </span>
      </div>
    </div>
  </div>
</template>