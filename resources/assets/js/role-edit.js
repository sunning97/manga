var name = $('.page-title').data('name');
var id = $('.page-title').data('id');
var app = new Vue({
    el: '#app',
    data: {
        name:name,
        perSelected: [],
        roles:[],
        levels:[]
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
        getPermission: function(){
            axios.get('/admin/axios/permissions/'+id).then(rs => {
                this.perSelected = rs.data;
            }).catch(e =>{});
        },
        getRoles:function () {
            axios.get('/admin/axios/roles').then(response=>{
                this.roles = response.data;
                let levels = [];
                for (let i = 1;i<=20;i++)
                {
                    let found = false;
                    for(let j = 0;j<this.roles.length;j++) {
                        if(this.roles[j].level == i) {
                            found = true;
                            break;
                        }
                    }
                    if(found == false) levels.push(i);
                }
                this.levels = levels;
            });
        }
    },mounted: function () {
        this.getPermission();
        this.getRoles();
    }
});

$(".select2").select2();
