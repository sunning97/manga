var app = new Vue({
    el: '#app',
    data: {
        isPortrait: false,
        name:$('.active').data('name') ? $('.active').data('name') : '',
        roles:[],
        levels:[]
    },
    watch: {
        name: function (str) {
            this.getSlug(str);
        }
    },
    mounted(){
        this.getRoles();
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
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
        },
    }
});