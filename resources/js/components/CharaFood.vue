<template>
  <div class="message-chara">
    <h3>▼ えさやり</h3>

    <div class="chara-index">
      <div class="chara-index-food">
        <div
          v-for="food in this.foods"
          v-bind:key="food.id"
          v-bind:class="{active: $store.state.selectedSubCursor === (food.id - 1)}"
        >
          <span v-text="food.name"></span>
          <input type="text" id="`food_${food.id}`" placeholder="数値" />
          <span></span>
          <span>個</span>
        </div>
      </div>

      <div class="register" v-bind:class="{active: $store.state.selectedSubCursor === 4}">
        <h4>あげる</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["foods"],
  created: function() {
  },
  data() {
    return {
    };
  },
  methods: {}
};
</script>