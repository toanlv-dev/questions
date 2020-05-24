<template>
    <div class="row mt-4" v-cloak>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ title }} </h2>
                        <hr>
                        <answer @delete="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id"></answer>
                        <div class="text-center mt-2" v-if="nextUrl">
                            <button class="btn btn-outline-secondary" @click="fetch(nextUrl)">
                                Load more answers
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import answer from './Answer.vue'
    export default {
        name: "answers",
        props: ['question'],

        data() {
            return {
                questionId: this.question.id,
                count: this.question.answers_count,
                answers: [],
                nextUrl: null
            }
        },

        created() {
            this.fetch(`/questions/${this.questionId}/answers`);
        },

        methods: {
            remove  (index) {
                this.answers.splice(index, 1);
                this.count --;
            },

            fetch (endpoint) {
                axios.get(endpoint)
                    .then(({data}) => {
                        this.answers.push(... data.data);
                        this.nextUrl = data.next_page_url
                    });
            }
        },

        computed: {
            title() {
                return this.count + " " + (this.count> 0? 'Answers' : 'Answer')
            }
        },
        components: {
            answer
        }
    }
</script>

<style scoped>

</style>
