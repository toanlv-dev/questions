<answer :answer="{{ $answer }}" inline-template>
    <div class="media">
        <vote :model="{{ $answer }}" name="answer"></vote>
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
                        @can('update', $answer)
                            <a class="btn btn-outline-info btn-sm" @click.prevent="edit">Edit</a>
                        @endcan
                        @can('delete', $answer)
                                <button class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                        @endcan
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="{{ $answer }}" label="Answered"> </user-info>
                    </div>

                </div>
            </div>
        </div>
    </div>

</answer>
