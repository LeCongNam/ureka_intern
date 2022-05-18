import { react, useEffect, useState } from "react";
const axios = require('axios').default;

function Details() {
    const [list, setList] = useState([]);

    useEffect(() => {
        axios.get('http://local-demo.com/api/details')
            .then(function (response) {
                // handle success
                let { data } = response;
                setList([data]);

                console.log(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }, []);

    return (
        <div>
            <ul>
                {
                    list && list.map((item, index) => (
                        <li key={index}>{item.name}</li>
                    ))
                }

            </ul>
        </div>
    )
}

export default Details