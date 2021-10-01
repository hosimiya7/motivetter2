<template>
  <div class="message-achieve">
    <h3>▼ 達成入力</h3>

    <div class="achieve" v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">
      <span>入力:</span>
      <input type="text" name id="achieve" placeholder="3" />
      <span>(単位) 達成！！</span>
    </div>
    <div class="register" v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">
      <span>登録</span>
    </div>
  </div>
</template>

<script>
export default {
  created: function() {

  },
  mounted() {

  },
  data() {
    return {

    };
  },
  methods: {

  }
};
</script>