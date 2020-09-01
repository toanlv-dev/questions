<template>
    <div>
        <span class="mt-2">{{ postDate }}</span>
        <div class="media mt-1">
            <a :href="user.url" class="pr-2"><img :src="user.avatar"></a>
            <div class="media-body mt-1">
                <a :href="user.url" class="pr-2">{{ user.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserInfo",
        props: ['model', 'label'],
        computed: {
            postDate () {
                return this.label + " " + this.model.created_date;
            }
        },
        data() {
            return {
                user : this.model.user
            }
        }
    }
</script>

<style scoped>

</style>
