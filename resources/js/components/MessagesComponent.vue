<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mensagens Socket</div>
                    <div class="card-body">
                        <ul>
                            <li v-for="item in messages" :key="item.id">{{ item.message }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                messages: [],
            }
        },
        mounted() {
            /*Nesse ponto falamos para toda vez que esse component carregar ele vai se conectar no canal messages e ouvir os eventos newMessage que serão disparados por ele e quando receber esse evento o valor vai ser adicionado na variável messages */
            window.Echo.channel('messages')
                .listen('.newMessage', (message) => {
                    this.messages.push(message);
                });
        }
    }
</script>