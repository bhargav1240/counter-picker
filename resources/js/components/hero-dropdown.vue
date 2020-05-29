<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="row m-4">
                    <div class="col-sm-2">
                        <button class="btn bnt-sm btn-primary" @click="
                                                                    selected_heroes = []
                                                                    counterHeroes = []
                                                                    ">reset</button>
                    </div>
                    <div class="col-sm-8">
                        <v-select
                            multiple
                            placeholder="Choose up to 5 Heroes!"
                            v-model="selected_heroes"
                            label="name"
                            :options="heroes"
                            :selectable="() => selected_heroes.length < 5"
                            ></v-select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn bnt-sm btn-primary" @click="getCounterHeroes()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-for="c in counterHeroes">
            <div class="col-8 mx-auto">
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
            selected_heroes: [],
            counterHeroes: []
        }
    },

    mounted(){
        this.fetchHeroes();
    },

    methods: {
        fetchHeroes(){
            axios.get(this.url + '/heroes')
            .then(res => {
                this.heroes = res.data;
                console.log(this.heroes[0].name);
            })
            .catch(errors => console.log(errors));
        },
        getCounterHeroes(){
            axios.post(this.url + '/on_select_hero',{
                data: this.selected_heroes
            })
            .then(res => {
                this.counterHeroes = res.data;
                this.counterHeroes.sort((a, b) => b.score - a.score);
                this.counterHeroes.sort((a, b) => b.count - a.count);
            })
            .catch(errors => console.log(errors));
        },
    },
}
</script>