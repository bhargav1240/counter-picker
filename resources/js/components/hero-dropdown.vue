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
                        <div class="row">
                            <div class="col">
                                {{ c.count }}
                            </div>
                            <div class="col">
                                {{ c.name }}
                            </div>
                            <div class="col">
                                {{ c.score }}
                            </div>
                        </div>
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
                this.counterHeroes.sort(function(a, b){
                    return b.count - a.count;
                });
            })
            .catch(errors => console.log(errors));
        }
    },
}
</script>