import { Box, Button, Heading } from '@dracula/dracula-ui';
import { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { Puff } from 'react-loading-icons'

import env from "react-dotenv";

const API_IP =  env.API + "/getByIP"
const API_MALHAS = "https://servicodados.ibge.gov.br/api/v3/malhas/municipios/"
const API_MUNICIPIOS = "https://servicodados.ibge.gov.br/api/v1/localidades/municipios"

function Where() {
    const [image, setImage] = useState("")
    const [myCity, setMyCity] = useState("")

    let navigate = useNavigate();

    useEffect(() => {
        async function handle() {
            const { Mensage } = await (await fetch(API_IP)).json()
            const city = Mensage;
            if (city) {
                try {
                    const all = await (await fetch(API_MUNICIPIOS)).json()
                    const [metadados] = all.filter((e) => e.nome === city);
                    if (metadados.id > 0) {
                        const svg = await (await fetch(API_MALHAS + metadados.id + "?preenchimento=E0E0E0")).blob()
                        const doc = URL.createObjectURL(svg)
                        setMyCity(city)
                        setImage(doc)
                    }
                } catch (e) {
                    navigate("/erramos", { replace: true });
                }
            }
        }
        handle();
    }, []);

    return (
        <section>

            <div className='container-app'>
                {myCity ?
                    <Box>
                        <Heading>
                            Achamos que voce está em <br></br>
                             <i>{myCity}</i> </Heading>
                        <div style={{ margin: "20px auto" }}>
                            <img alt="Me" width="100%" src={image} />
                        </div>
                        <Box>
                            <Link to={`/erramos/`}>
                                <Button color="pinkPurple" m="sm" size='lg'>
                                   Tentem de novo 🤨
                                </Button>
                            </Link>
                        </Box>
                        <Box style={{ position: "fixed", bottom: "10px", left: "0", width: "100%" }}>
                            <Link to={`/`}>
                            <Button color="white" m="sm">
                                    Voltar
                            </Button>
                            </Link>
                        </Box>

                    </Box>
                    : <><Puff stroke="pink" strokeOpacity={.925} speed={.75} /></>
                }
            </div>
        </section>
    )
}

export default Where;