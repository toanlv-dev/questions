<template>
    <div class="d-flex flex-column vote-controls">
        <a :title="title('up')"
           class="vote-up" :class="classes"
           @click.prevent="voteUp"
        >
            <i class="fas fa-caret-up fa-2x"> </i>
        </a>
        <span class="votes-count">{{ count }}</span>
        <a :title="title('down')"
           class="vote-down" :class="classes"
           @click.prevent="voteDown"
        >
            <i class="fas fa-caret-down fa-2x"></i>
        </a>

        <favorite v-if="name == 'question'" :question="model"> </favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
    import Favorite from "./Favorite";
    import Accept from "./Accept";

    export default {
        name: "Vote",
        props: ['model', 'name'],
        components: {
            Favorite,
            Accept
        },
        data() {
            return {
                count: this.model.votes_count,
                id: this.model.id
            }
        },
        computed: {
            classes() {
                return this.signedIn? '' : 'off';
            },

            endpoint() {
                return `/${this.name}s/${this.id}/vote`
            }
        },

        methods: {
            title(typeVote) {
                let titles = {
                    up: `This ${this.name} is useful`,
                    down: `This ${this.name} is not useful`
                }
                return titles[typeVote];
            },

            voteUp() {
                this._vote(1);
            },

            voteDown() {
                this._vote(-1)
            },

            _vote(vote) {
                if(!this.signedIn) {
                    this.$toast.warning('Please login!', 'Warning!', {
                        timeout: 3000
                    });
                    return;
                }
                axios.post(this.endpoint, {
                    vote: vote
                }).then(res => {
                    this.$toast.success(res.data.message, 'Success!', {
                        timeout: 3000
                    })
                    this.count = res.data.votesCount;
                })
            }
        }
    }
</script>

<style scoped>

</style>
