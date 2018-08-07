<template>
    <div>
        <h5>3 Bình luận</h5>
        <ul class="post__comments-list" id="commnent">
            <li class="post__comments-item">
            <div class="post__comments-item-body">
                <div class="post__comments-item-avatar">
                    <img src="img/comment1.jpg" alt="Comment Author">
                </div>
                <div class="post__comments-item-right">
                    <div class="post__comments-item-reply">
                        <a href="#">Reply</a>
                    </div>
                    <div class="post__comments-item-info">
                        <div class="post__comments-item-info-author">
                          <span>
                            <a href="#">Matt Kian</a>
                          </span>
                        </div>
                        <div class="post__comments-item-info-date">
                          <span>
                            <a href="#">March 30, 2017 at 2:28 pm</a>
                          </span>
                        </div>
                    </div>
                    <div class="post__comments-item-post">
                        <p>Dignissim pharetra consequat condimentum scelerisque. Vestibulum sagittis scelerisque montes enim Cursus dui lectus cras mattis Laoreet aliquam varius ut adipiscing interdum lacus risus mattis urna semper cras hendrerit, morbi nonummy.</p>
                    </div>
                </div>
            </div>
            <ul class="post__comments-children">
                <li class="post__comments-item">
                    <div class="post__comments-item-body">
                        <div class="post__comments-item-avatar">
                            <img src="img/comment2.jpg" alt="Comment Author">
                        </div>
                        <div class="post__comments-item-right">
                            <div class="post__comments-item-reply">
                                <a href="#">Reply</a>
                            </div>
                            <div class="post__comments-item-info">
                                <div class="post__comments-item-info-author">
                              <span>
                                <a href="#">Olyvia Becca</a>
                              </span>
                                </div>
                                <div class="post__comments-item-info-date">
                              <span>
                                <a href="#">April 11, 2017 at 7:35 pm</a>
                              </span>
                                </div>
                            </div>
                            <div class="post__comments-item-post">
                                <p>Aliquet arcu cubilia dignissim natoque posuere vestibulum malesuada integer Ridiculus suscipit justo In tempus penatibus diam arcu dictumst felis scelerisque nunc blandit cubilia condimentum class justo natoque volutpat nam.</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
            <li class="post__comments-item">
            <div class="post__comments-item-body">
                <div class="post__comments-item-avatar">
                    <img src="img/comment3.jpg" alt="Comment Author">
                </div>
                <div class="post__comments-item-right">
                    <div class="post__comments-item-reply">
                        <a href="#">Reply</a>
                    </div>
                    <div class="post__comments-item-info">
                        <div class="post__comments-item-info-author">
                          <span>
                            <a href="#">Jess Lavone</a>
                          </span>
                        </div>
                        <div class="post__comments-item-info-date">
                          <span>
                            <a href="#">April 15, 2017 at 8:32 pm</a>
                          </span>
                        </div>
                    </div>
                    <div class="post__comments-item-post">
                        <p>Dapibus ullamcorper ullamcorper class potenti sed, rhoncus arcu. Ligula iaculis aliquet, interdum luctus porttitor lacinia eu etiam. Pede elementum nisl dui facilisis at, metus facilisi, class consectetuer. Feugiat malesuada dis.</p>
                    </div>
                </div>
            </div>
        </li>
        </ul>
    </div>
</template>
<script>
    export default {
        mounted(){
            $('#commnent').slimScroll({
                height: '500px',
            });
        }
    }
</script>