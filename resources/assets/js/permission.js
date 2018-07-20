
var app = new Vue({
    el: '#app',
    data: {
        name:'',
        searchResult:[]
    },
    methods: {
        showDelete: function(event) {
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "bạn sẽ không thể phục hồi lại quyền này",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: false
            }, function(){
                axios.delete($(event.path[0]).data('href')).then(rs => {
                    swal("Đã xóa!", rs.data +" đã được xóa bỏ", "success");
                    location.reload();
                }).catch(e =>{});
            });
        },
        getSearch: function () {
            var app = this;
            axios.post('/admin/axios/search-permission',{
                name:app.name
            }).then(rs => {
                if(app.name.length > 0) {
                    app.searchResult = rs.data;
                } else {
                    app.searchResult = [];

                }
            }).catch(e =>{});
        }
    },watch:{
        name: function () {
            this.getSearch();
        }
    }
});
