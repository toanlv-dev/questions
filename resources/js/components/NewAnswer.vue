<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3> Your Answer </h3>
                        <hr>
                        <form @submit.prevent="create">
                            <div class="form-group">
                                <textarea required rows="6" v-model="body" class="form-control"> </textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-primary btn-lg" type="submit" :disabled="isInvalid"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "NewAnswer",
        props: ['questionId'],

        methods: {
          create() {
              axios.post(`/questions/${this.questionId}/answers`, {
                  body: this.body
              })
              .catch(err => {
                  this.$toast.error(err.response.data.message, "Error");
              })
              .then(({data}) => {
                  this.$toast.success(data.message, "Success");
                  this.body = '';
                  this.$emit('created', data.answer);
              })
          }
        },
        data() {
            return {
                body: ''
            }
        },

        computed: {
            isInvalid() {
                return !this.signedIn || this.body.length < 10;
            }
        }
    }
</script>

<style scoped>

</style>
