<template>
    <a title="Click to mark as favorite Question"
       :class="classes"
       @click.prevent="toggle"
    >
        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
    export default {
        name: "Favorite",
        props: ['question'],
        data() {
            return {
                count : this.question.favorites_count,
                isFavorited: this.question.is_favorited,
                id: this.question.id
            }
        },
        computed: {
            classes () {
                return [
                    'favorite', 'mt-2', this.signedIn? (this.isFavorited? 'favorited' : '') : 'off'
                ]
            },
            endpoint() {
                return `/questions/${this.id}/favorites`
            }
        },
        methods: {
            toggle() {
                if(!this.signedIn) {
                    this.$toast.warning('Please login to favotire this question!', 'Warning', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    })
                }
                this.isFavorited? this.destroy() : this.create()
            },

            destroy() {
                axios.delete(this.endpoint)
                .then(res => {
                    this.count--;
                    this.isFavorited = false;
                })
            },

            create() {
                axios.post(this.endpoint)
                    .then(res => {
                        this.count++;
                        this.isFavorited = true;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
