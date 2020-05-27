<template>
    <div>
        <ul>
            <li v-for="c in counterHeroes">{{ c.name }}
                <ul>
                    <li>{{ c.score }}</li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0,
            counterHeroes: []
        }
    },
    methods:{
        onSeelectHero(t){
            axios.post(this.url + '/on_select_hero',{
                data: t
            })
            .then(res => {
                this.counterHeroes = res.data;
            })
            .catch(errors => console.log(errors));
        }
    }
}
</script>