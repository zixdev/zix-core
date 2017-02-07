<default-settings-profile-avatar-screen inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Photo</div>

        <div class="panel-body">
            <div class="alert alert-success" v-if="getError('message')">
                <i class="fa fa-btn fa-check-circle"></i>
                @{{ getError('message') }}
            </div>

            <div class="center-block text-center">
                <img width="150px" v-if="user.avatar" class="img-thumbnail ounded mx-auto d-block" :src="user.avatar">
                <img v-else class="img-responsive" src="https://www.gravatar.com/avatar/8798bd6307b5288654155f168d4288bf.jpg?s=200&amp;d=mm">
                <br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#select-avatar">
                    Select New Photo
                </button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="select-avatar" tabindex="-1" role="dialog" aria-labelledby="select-avatar" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <ul class="nav nav-tabs modal-header" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#select-image" role="tab">Select From My Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#upload-image" role="tab">Upload New One</a>
                        </li>
                    </ul>
                    <div class="modal-body">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane" id="select-image" role="tabpanel">
                                <div class="row">
                                    <a href="javascript:void(0);" v-for="image in images"
                                    @click="selectAvatar(image)"
                                    class="col-md-3 text-md-center"
                                    style="height: 200px"
                                    :title="image.name"
                                    >
                                    <img :src="image.url"
                                         class="img-fluid img-thumbnail">
                                        <span >
                                            @{{ image.name.substring(0, 10) }} ...
                                        </span>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="tab-pane active" id="upload-image" role="tabpanel">
                                <form class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</default-settings-profile-avatar-screen>

