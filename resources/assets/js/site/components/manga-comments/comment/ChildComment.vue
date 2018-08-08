<template>
    <div>
        <ul class="post__comments-children mb-5" v-for="comment in comments">
            <li class="post__comments-item">
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-responsive" :src="`${url}/${comment.avatar}`" alt="Comment Author">
                    </div>
                    <div class="col-md-10" style="background-color: rgb(214, 214, 214)">
                        <div class="post__comments-item-info">
                            <div class="post__comments-item-info-author">
                                  <span>
                                    <a href="#">{{ `${comment.f_name} ${comment.l_name}` }}</a>
                                  </span>
                            </div>
                            <div class="post__comments-item-info-date">
                                  <span>
                                    <a href="#">{{ date_format(comment.created_at) }}</a>
                                  </span>
                            </div>
                        </div>
                        <div class="">
                            <p>{{ comment.content }}</p>
                        </div>
                    </div>
                </div>
                <hr>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props:{
            comments:{
                type:Array,
                default:[]
            },
            url:{
                type:String,
                default:''
            }
        },
        methods:{
            date_format:function (str) {
                return $.format.date(str, "dd-MM-yyyy");
            }
        }
    }
</script>