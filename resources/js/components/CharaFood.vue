<template>
  <div class="message-chara">
    <h3>▼ えさやり</h3>

    <div class="chara-index">
      <div class="chara-index-first chara-food">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">
          いちご
          <input type="text" name="strawberry" id="strawberry" placeholder="数値" />
          <span v-text="this.$store.state.foods[1]"></span>
          <span>個</span>
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">
          おもち
          <input type="text" name="mochi" id="mochi" placeholder="数値" />
          <span v-text="this.$store.state.foods[2]"></span>
          <span>個</span>
        </span>
      </div>
      <div class="chara-index-second chara-food">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">
          メロン
          <input type="text" name="melon" id="melon" placeholder="数値" />
          <span v-text="this.$store.state.foods[3]"></span>
          <span>個</span>
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">
          葉っぱ
          <input type="text" name="grass" id="grass" placeholder="数値" />
          <span v-text="this.$store.state.foods[4]"></span>
          <span>個</span>
        </span>
      </div>
      <div class="register" v-bind:class="{active: this.$store.state.selectedSubCursor === 4}">
        <h4>あげる</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created: function() {},
  data() {
    return {};
  },
  methods: {}
};
</script>