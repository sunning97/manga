var app = new Vue({
    el: '#app',
    data: {
        name: $('.page-title').data('name'),
        mangas:[],
        chapImage:[],
        imageEdit:null,
        noInputImage: false
    },
    watch: {
        name: function (str) {
            this.getSlug(str);
        }
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
        },
        getMangas: function(){
            axios.get('/admin/axios/mangas').then(rs => {
                this.mangas = rs.data;
            }).catch(e =>{});
        },
        getChapImages: function(){
            axios.get('/admin/axios/chap-images/'+$('.page-title').data('id')).then(rs => {
                this.chapImage = rs.data;
            }).catch(e =>{});
        },
        showDelete: function (index,chapImage) {
            var app = this;
            var id = app.chapImage[index].id;
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "bạn sẽ không thể phục hồi lại ảnh này",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: true
            }, function(){
                axios.get('/admin/axios/delete-chap-image/'+id).then(rs => {
                    app.getChapImages();
                    swal("Thành công!", "Đã xóa "+rs.data, "success");
                }).catch(e =>{});
            });
        },
        showEdit: function (index) {
            this.imageEdit = this.chapImage[index];
        },
        editImage: function (event) {
            var el = $(event.path[0]).parent().prev().children().children().children().children('.form-group').children().children('input');
            if(!el.val()){
                this.noInputImage  = true;
                return false;
            }
            var formData = new FormData();
            this.noInputImage = false;
            formData.append("image", el[0].files[0]);
            formData.append("id",this.imageEdit.id);

            axios.post('/admin/axios/chap-image-edit', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(rs => {
                app.getChapImages();
                swal("Thành công!", "Cập nhật thành công", "success");
                el.val('');
            }).catch(e =>{});
        }
    },
    mounted: function () {
        this.getChapImages();
        this.getMangas();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();


