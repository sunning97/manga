var app = new Vue({
    el: "#app",
    data:{
        name: "",
        searchResult: []
    },
    watch:{
        name: function () {
            this.getSearch();
        },
    },
    methods:{
        getSearch: function () {
            let app = this;
            if(app.name.length > 0){
                axios.post('/manga/axios/search-author',{
                    name: app.name
                }).then(rs => {
                    app.searchResult = rs.data;
                }).catch(err => {
                    app.searchResult = [];
                });
            } else {
                app.searchResult = [];
            }
        },
        date_format: function (str) {
            return date_format(str);
        },
        showDelete: function (event) {
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "Bạn sẽ không thể phục hồi lại",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: true
            }, function(){
                axios.delete($(event.path[0]).data('url')+'/authors/'+$(event.path[0]).data('id')).then(rs => {
                    swal("Đã xóa!", rs.data +" đã được xóa bỏ", "success");
                    location.reload();
                }).catch(e =>{
                    swal("Không thể xóa!", "Kiểm tra lại đường truyền", "error");
                });
            });
        }
    },
});