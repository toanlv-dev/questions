<template>
    <a v-if="authorize('accept', answer)" title="Click to mark as best answer"
       :class="classes"
       @click.prevent="create"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <a v-else-if="accepted" title="This answer as best answer"
       :class="classes"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>

</template>

<script>
    import EventBus from "../event-bus";
    export default {
        name: "Accept",
        props: ['answer'],
        data() {
            return {
                isBest: this.answer.is_best,
                id: this.answer.id
            }
        },

        created() {
            EventBus.$on('accepted', id => {
                this.isBest = (id === this.id);
            })
        },

        methods: {
            create() {
                axios.post(`/answers/${this.id}/accept`)
                .then(res => {
                    this.$toast.success(res.data.message, 'Success', {
                        timeout: 3000
                    });
                    this.isBest = true;
                    EventBus.$emit('accepted', this.id);

                })
            }
        },
        computed: {
            canAccept() {
                return true;
            },

            accepted() {
                return !this.canAccept && this.isBest;
            },

            classes() {
                return [
                    'mt-2',
                    this.isBest ? 'vote-accepted' : ''
                ]
            }
        }
    }
</script>

<style scoped>

</style>
