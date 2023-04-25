# Laravel HTTP RESTful API

A (very) simple implementation of a RESTful API, including HATEOAS and content negotiation, to explore 'true'
RESTfulness according
to [Roy Fielding's Dissertation](https://www.ics.uci.edu/~fielding/pubs/dissertation/fielding_dissertation.pdf).

<p align="center">
  <img src="https://static.thenounproject.com/png/164461-200.png" alt="Stolen Wizard Image"/>
</p>

## Relationships

A `Wizard` has a collection of `Spell`, and a `Spell` has a `SpellType`.

Both `Wizard` and `Spell` support the embedding of relationships.

```
/api/wizards?embed=spells
/api/wizards?embed=spells,spell_type
/api/spells?embed=spell_type
```

## Routes

```
  GET|HEAD        api/spell_types ...................................... spell_types.index › SpellTypeController@index
  POST            api/spell_types ...................................... spell_types.store › SpellTypeController@store
  GET|HEAD        api/spell_types/{spell_type} ........................... spell_types.show › SpellTypeController@show
  PUT|PATCH       api/spell_types/{spell_type} ....................... spell_types.update › SpellTypeController@update
  DELETE          api/spell_types/{spell_type} ..................... spell_types.destroy › SpellTypeController@destroy
  GET|HEAD        api/spells .................................................... spells.index › SpellController@index
  POST            api/spells .................................................... spells.store › SpellController@store
  GET|HEAD        api/spells/{spell} .............................................. spells.show › SpellController@show
  PUT|PATCH       api/spells/{spell} .......................................... spells.update › SpellController@update
  DELETE          api/spells/{spell} ........................................ spells.destroy › SpellController@destroy
  GET|HEAD        api/wizards ................................................. wizards.index › WizardController@index
  POST            api/wizards ................................................. wizards.store › WizardController@store
  GET|HEAD        api/wizards/{wizard} .......................................... wizards.show › WizardController@show
  PUT|PATCH       api/wizards/{wizard} ...................................... wizards.update › WizardController@update
  DELETE          api/wizards/{wizard} .................................... wizards.destroy › WizardController@destroy
```

## Examples

<details>
<summary>
http://wizard.test/api/wizards
</summary>

```json
[
    {
        "data": {
            "id": 1,
            "name": "Balthazar",
            "spells": [
                2,
                1
            ]
        },
        "links": {
            "self": "http://wizard.test/api/wizards/1",
            "collection": "http://wizard.test/api/wizards",
            "embed": "http://wizard.test/api/wizards/1?embed=spells"
        }
    },
    {
        "data": {
            "id": 2,
            "name": "Vinny",
            "spells": [
                2,
                3,
                4
            ]
        },
        "links": {
            "self": "http://wizard.test/api/wizards/2",
            "collection": "http://wizard.test/api/wizards",
            "embed": "http://wizard.test/api/wizards/2?embed=spells"
        }
    }
]
```

</details>
<details>
<summary>
http://wizard.test/api/wizards?embed=spells,spell_type
</summary>

```json
[
    {
        "data": {
            "id": 1,
            "name": "Balthazar",
            "spells": [
                {
                    "data": {
                        "id": 2,
                        "name": "Splash",
                        "spell_type": {
                            "data": {
                                "id": 1,
                                "type": "Water"
                            },
                            "links": {
                                "self": "http://wizard.test/api/spells/1",
                                "collection": "http://wizard.test/api/spells",
                                "spells": "http://wizard.test/api/spells?spell_type=1"
                            }
                        },
                        "damage": 1
                    },
                    "links": {
                        "self": "http://wizard.test/api/spells/2",
                        "collection": "http://wizard.test/api/spells",
                        "wizards": "http://wizard.test/api/wizards?spell=2",
                        "embed": "http://wizard.test/api/spells/2?embed=spell_type"
                    }
                },
                {
                    "data": {
                        "id": 1,
                        "name": "Vuurbal",
                        "spell_type": {
                            "data": {
                                "id": 2,
                                "type": "Fire"
                            },
                            "links": {
                                "self": "http://wizard.test/api/spells/2",
                                "collection": "http://wizard.test/api/spells",
                                "spells": "http://wizard.test/api/spells?spell_type=2"
                            }
                        },
                        "damage": 2
                    },
                    "links": {
                        "self": "http://wizard.test/api/spells/1",
                        "collection": "http://wizard.test/api/spells",
                        "wizards": "http://wizard.test/api/wizards?spell=1",
                        "embed": "http://wizard.test/api/spells/1?embed=spell_type"
                    }
                }
            ]
        },
        "links": {
            "self": "http://wizard.test/api/wizards/1",
            "collection": "http://wizard.test/api/wizards",
            "embed": "http://wizard.test/api/wizards/1?embed=spells"
        }
    },
    {
        "data": {
            "id": 2,
            "name": "Vinny",
            "spells": [
                {
                    "data": {
                        "id": 2,
                        "name": "Splash",
                        "spell_type": {
                            "data": {
                                "id": 1,
                                "type": "Water"
                            },
                            "links": {
                                "self": "http://wizard.test/api/spells/1",
                                "collection": "http://wizard.test/api/spells",
                                "spells": "http://wizard.test/api/spells?spell_type=1"
                            }
                        },
                        "damage": 1
                    },
                    "links": {
                        "self": "http://wizard.test/api/spells/2",
                        "collection": "http://wizard.test/api/spells",
                        "wizards": "http://wizard.test/api/wizards?spell=2",
                        "embed": "http://wizard.test/api/spells/2?embed=spell_type"
                    }
                },
                {
                    "data": {
                        "id": 3,
                        "name": "Sandblast",
                        "spell_type": {
                            "data": {
                                "id": 3,
                                "type": "Earth"
                            },
                            "links": {
                                "self": "http://wizard.test/api/spells/3",
                                "collection": "http://wizard.test/api/spells",
                                "spells": "http://wizard.test/api/spells?spell_type=3"
                            }
                        },
                        "damage": 1
                    },
                    "links": {
                        "self": "http://wizard.test/api/spells/3",
                        "collection": "http://wizard.test/api/spells",
                        "wizards": "http://wizard.test/api/wizards?spell=3",
                        "embed": "http://wizard.test/api/spells/3?embed=spell_type"
                    }
                },
                {
                    "data": {
                        "id": 4,
                        "name": "Gust of wind",
                        "spell_type": {
                            "data": {
                                "id": 4,
                                "type": "Air"
                            },
                            "links": {
                                "self": "http://wizard.test/api/spells/4",
                                "collection": "http://wizard.test/api/spells",
                                "spells": "http://wizard.test/api/spells?spell_type=4"
                            }
                        },
                        "damage": 1
                    },
                    "links": {
                        "self": "http://wizard.test/api/spells/4",
                        "collection": "http://wizard.test/api/spells",
                        "wizards": "http://wizard.test/api/wizards?spell=4",
                        "embed": "http://wizard.test/api/spells/4?embed=spell_type"
                    }
                }
            ]
        },
        "links": {
            "self": "http://wizard.test/api/wizards/2",
            "collection": "http://wizard.test/api/wizards",
            "embed": "http://wizard.test/api/wizards/2?embed=spells"
        }
    }
]
```

</details>

