<template>
    <div class="chat-left-aside">
        <div class="open-panel"><i class="ti-angle-right"></i></div>
        <div class="chat-left-inner">
            <div class="form-material">
                <input class="form-control p-20" type="text" placeholder="Tìm kiếm..."></div>
            <ul class="chatonline style-none" >
                <li v-for="contact in contacts" @click="selectContact(contact)">
                    <a href="javascript:void(0)"><img :src="`${path}/${contact.avatar}`" :alt="`${contact.f_name} ${contact.l_name}`" class="img-circle"> <span>{{ `${contact.f_name} ${contact.l_name}` }} <small class="text-success">online</small></span></a>
                </li>
                <li class="p-20"></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            contacts:{
                type:Array,
                require:true,
                default:[]
            },
            path:{
                type:String,
                default:''
            }
        },
        data(){
            return{
                selectedContact:null,
            }
        },
        mounted(){
            $('.chat-left-inner > .chatonline').slimScroll({
                height: '100%',
                position: 'right',
                size: "0px",
                color: '#dcdcdc',

            });
            $('.chat-left-inner').css({'height': (($(window).height()) - 240) + 'px'});
        },
        methods:{
            selectContact:function (contact) {
                this.selectedContact = contact;
                this.$emit('contact',contact);
            }
        }
    }

</script>