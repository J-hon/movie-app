import React, { useEffect, useState } from "react";
import Auth from '../Layouts/Auth';
import MovieService from "../services/movies";
import Add from "../Components/Buttons/Add";
import Remove from "../Components/Buttons/Remove";
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export default function Dashboard() {

    const [ movies, setMovies ]   = useState([]);
    const [ trigger, setTrigger ] = useState(false);

    useEffect(() => {
        MovieService.get()
            .then(response => {
                setMovies(response.data)
            })
            .catch(err => {
                console.log(err.response.data);
            });
    }, [ trigger ]);

    const addToMovieList = (id) => {
        MovieService.add(id)
            .then(response => {
                setTrigger(prevState => !prevState);
                toast(response.message);
            })
            .catch(err => {
                console.log(err.response.data);
            });
    }

    const removeFromMovieList = (id) => {
        MovieService.remove(id)
            .then(response => {
                setTrigger(prevState => !prevState);
                toast(response.message);
            })
            .catch(err => {
                console.log(err.response.data);
            });
    }

    return (
        <>
            <Auth>
                <div className="bg-white">
                    <div className="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                        <h2 className="text-xl font-bold text-gray-900">Movies</h2>

                        <div className="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                            {movies.map((movie) => (
                                <div key={ movie.id }>
                                    <div className="relative">
                                        <div className="relative h-72 w-full overflow-hidden rounded-lg">
                                            <img
                                                src={ movie.image }
                                                alt={ movie.title }
                                                className="h-full w-full object-cover object-center"
                                            />
                                        </div>

                                        <div className="relative mt-4">
                                            <h3 className="text-sm font-medium text-gray-900">{ movie.title }</h3>
                                            <span className="mt-1 text-sm text-gray-500">{ movie.genres.join(', ') }</span>
                                        </div>
                                    </div>

                                    <div className="mt-6">
                                        { !movie.exists_in_list ?
                                            (<Add
                                                addToMovieList={ addToMovieList }
                                                id={ movie.id }
                                            />) : (<Remove
                                                removeFromMovieList={ removeFromMovieList }
                                                id={ movie.id }
                                            />)
                                        }
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </Auth>
        </>
    );
};
