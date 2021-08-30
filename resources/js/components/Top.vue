<template>
    <div class="wrapper">
        <h1>もちべった～～</h1>
        <div class="main-wrapper">
            <div class="flex">
                <div class="command">
                    <Commands></Commands>
                </div>
                <div class="goal">
                    <span>{{ items.number }}</span><span>{{ items.unit }}</span><span>{{ items.goal }}</span>
                </div>
                <div class="status">
                    <ul>
                        <li>
                            名前：（設定した名前）
                        </li>
                        <li>
                            現在の経験値：（現在の経験値）
                        </li>
                    </ul>
                </div>
            </div>
            <div class="char">
                <MyCanvas></MyCanvas>
                <!-- （ここにキャラクターが入ります） -->
            </div>
            <div class="message">
                <Message></Message>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import MyCanvas from './MyCanvas.vue'
    import Commands from './Commands.vue'
    export default {
        components: {
            MyCanvas,
            Commands
        },
        data() {
            return{
                items: [] //データ格納
            }
        },
        mounted() {
            window.axios.get('/api/goal/show')
            .then(response =>{
                this.items = response['data'];
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
</script>