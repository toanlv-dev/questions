<template>
    <div class="media">
        <vote :model="answer" name="answer"></vote>
        <div class="media-body post">
            <form v-if="editing" v-on:submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" rows="10" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Edit</button>
                <button class="btn btn-outline-secondary" type="button" @click="cancle">Cancle</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"> </div>
                <div class="row">
                    <div class="col-4">
                        <a v-if="authorize('modify', answer)" class="btn btn-outline-info btn-sm" @click.prevent="edit">Edit</a>
                        <button v-if="authorize('modify', answer)" class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="answer" label="Answered"> </user-info>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Answer",
        props : ['answer'],
        data: function () {
            return {
                'editing' : false,
                'body' : this.answer.body,
                'bodyHtml' : this.answer.body_html,
                'id' : this.answer.id,
                'questionId' : this.answer.question_id,
                'beforeEditBody' : ''
            }
        },
        methods: {
            edit() {
                this.beforeEditBody = this.body;
                this.editing = true;
            },

            cancle() {
                this.body = this.beforeEditBody;
                this.editing = false;
            },

            update() {
                axios.patch(this.endpoint,{
                    body : this.body
                })
                    .then(res =>  {
                        this.editing = false;
                        this.bodyHtml = res.data.body_html
                        this.$toast.success(res.data.message, 'Success', {timeout: 3000});
                    })
                    .catch(function (error) {
                        this.$toast.error(error.response.data.message, 'Error', {timeout: 3000});
                    })
            },

            destroy() {
                this.$toast.question('Are you sure about that?','Question', {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {

                            axios.delete(this.endpoint)
                                .then(res => {
                                    this.$emit('delete');
                                })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ]
                });
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10;
            },
            endpoint() {
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>

<style scoped>

</style>
