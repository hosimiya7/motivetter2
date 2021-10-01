<template>
    <div class="message-chara">

        <h3>▼ えさやり</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">いちご</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">もち</span>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">メロン</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">にく</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    created: function() {

    },
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>