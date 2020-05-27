<template>
    <div>
        <div class="row mb-4">
            <div class="col-4 mx-auto">
                <select class="form-control" name="" id="" v-model="selected_hero_id" @change="onSeelectHero()">
                    <option v-for="hero in heroes" v-bind:value="hero.id">{{ hero.name }}</option>
                </select>
            </div>
        </div>

        <div class="row" v-for="c in counterHeroes">
            <div class="col-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        {{ c[0].name }}-{{c[0].score}}
                    </div>
                </div>
                <br/>
            </div>
        </div>
        

    </div>
</template>

<script>
export default {
    data: function(){
        return{
            heroes: [],
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0,
            counterHeroes: []
        }
    },

    mounted(){
        this.fetchHeroes();
        this.onSeelectHero();
    },

    methods: {
        fetchHeroes(){
            axios.get(this.url + '/heroes')
            .then(res => {
                this.heroes = res.data;
            })
            .catch(errors => console.log(errors));
        },
        onSeelectHero(){
            axios.get(this.url + '/on_select_hero')
            .then(res => {
                this.counterHeroes = res.data;
            })
            .catch(errors => console.log(errors));
        }
    },
}
</script>