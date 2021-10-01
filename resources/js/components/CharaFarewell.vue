<template>
    <div class="message-chara">

        <h3>▼ おわかれ</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <p>おわかれする？？</p>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">はい</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">いいえ</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    created: function() {
    },
    mounted: function() {
    },
    data() {
        return {
        }
    },
    methods: {
    }
}
</script>