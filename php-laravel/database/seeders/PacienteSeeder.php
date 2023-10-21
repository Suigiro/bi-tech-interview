<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pacientes;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if(Pacientes::all()->count() == 0){

            Pacientes::insert([
                [
                    'nome' => "Calebe Benjamin Moreira",
                    'cpf' => "252.479.361-32",
                    'rg' => "42.974.749-4",
                    'data_nasc' => "22/05/2005",
                    'sexo' => "Masculino",
                    'email' => "calebe-moreira90@omnibrasil.com.br",
                    'celular' => "(95) 99698-5216",
                    'descricao' => "Paciente 1",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Emilly Marcela Rosa Teixeira",
                    'cpf' => "435.698.217-73",
                    'rg' => "18.937.074-9",
                    'data_nasc' => "10/02/2005",
                    'sexo' => "Feminino",
                    'email' => "emilly_teixeira@metododerose.org",
                    'celular' => "(71) 98235-9717",
                    'descricao' => "Paciente 2",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Eduarda Isabel Silveira",
                    'cpf' => "073.596.621-41",
                    'rg' => "50.648.467-1",
                    'data_nasc' => "19/09/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(51) 98761-6918",
                    'descricao' => "Paciente 3",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Amanda Daiane Eduarda Caldeira",
                    'cpf' => "705.930.351-00",
                    'rg' => "42.654.713-5",
                    'data_nasc' => "09/07/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(98) 98192-1704",
                    'descricao' => "Paciente 4",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Eloá Yasmin Vieira",
                    'cpf' => "338.358.668-50",
                    'rg' => "38.595.291-0",
                    'data_nasc' => "23/01/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(67) 98370-7195",
                    'descricao' => "Paciente 5",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Benício Guilherme Pedro da Luz",
                    'cpf' => "188.997.083-20",
                    'rg' => "30.790.682-6",
                    'data_nasc' => "04/04/2005",
                    'sexo' => "Masculino",
                    'email' => "",
                    'celular' => "(84) 98441-3082",
                    'descricao' => "Paciente 6",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Fátima Raimunda das Neves",
                    'cpf' => "188.997.083-21",
                    'rg' => "30.790.682-x",
                    'data_nasc' => "03/06/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(95) 98502-8696",
                    'descricao' => "Paciente 7",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Daniela Marcela Cláudia Baptista",
                    'cpf' => "617.645.577-43",
                    'rg' => "38.712.526-7",
                    'data_nasc' => "14/08/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(63) 98844-2434",
                    'descricao' => "Paciente 8",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Rodrigo Erick Cavalcanti",
                    'cpf' => "330.167.896-39",
                    'rg' => "20.747.491-6",
                    'data_nasc' => "20/05/2005",
                    'sexo' => "Masculino",
                    'email' => "",
                    'celular' => "(71) 98254-1306",
                    'descricao' => "Paciente 9",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Severino Mário da Mota",
                    'cpf' => "928.796.295-27",
                    'rg' => "36.222.225-3",
                    'data_nasc' => "13/01/2005",
                    'celular' => "(69) 99276-1114",
                    'sexo' => "Masculino",
                    'email' => "",
                    'descricao' => "Paciente 10",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Bárbara Teresinha Helena Nogueira",
                    'cpf' => "716.734.707-85",
                    'rg' => "24.912.649-7",
                    'data_nasc' => "16/05/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(92) 98189-8909",
                    'descricao' => "Paciente 11",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Benedita Regina Brenda Monteiro",
                    'cpf' => "129.119.919-58",
                    'rg' => "49.716.772-4",
                    'data_nasc' => "11/09/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(35) 99397-8574",
                    'descricao' => "Paciente 12",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Eloá Regina Lara Rodrigues",
                    'cpf' => "682.510.176-53",
                    'rg' => "42.449.161-8",
                    'data_nasc' => "04/03/2005",
                    'sexo' => "Feminino",
                    'email' => "",
                    'celular' => "(81) 99439-3140",
                    'descricao' => "Paciente 13",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Danilo Sebastião Oliver Costa",
                    'cpf' => "928.472.051-60",
                    'rg' => "12.812.467-2",
                    'data_nasc' => "19/01/2005",
                    'sexo' => "Masculino",
                    'email' => "",
                    'celular' => "(98) 98298-6438",
                    'descricao' => "Paciente 14",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Anthony Gael Anderson Corte Real",
                    'cpf' => "388.172.855-44",
                    'rg' => "46.186.920-2",
                    'data_nasc' => "17/04/2005",
                    'sexo' => "Masculino",
                    'email' => "",
                    'celular' => "(82) 99839-9536",
                    'descricao' => "Paciente 15",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Bárbara Elza Rosa Assis",
                    'cpf' => "431.462.527-91",
                    'rg' => "47.429.449-3",
                    'data_nasc' => "12/01/2005",
                    'sexo' => "Feminino",
                    'email' => "barbara_elza_assis@redealumni.com",
                    'celular' => "(79) 99481-9558",
                    'descricao' => "Paciente 16",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Tânia Malu Analu Almada",
                    'cpf' => "188.380.533-32",
                    'rg' => "43.467.405-9",
                    'data_nasc' => "23/08/2005",
                    'sexo' => "Feminino",
                    'email' => "tania_almada@pubdesign.com.br",
                    'celular' => "(48) 99617-0039",
                    'descricao' => "Paciente 17",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Renata Maitê da Costa",
                    'cpf' => "779.561.375-60",
                    'rg' => "18.288.888-5",
                    'data_nasc' => "22/02/2005",
                    'sexo' => "Feminino",
                    'email' => "renata_dacosta@vanguarda.tv",
                    'celular' => "(79) 98561-1255",
                    'descricao' => "Paciente 18",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Vitor Luiz Fogaça",
                    'cpf' => "538.138.230-83",
                    'rg' => "42.529.314-2",
                    'data_nasc' => "22/06/2005",
                    'sexo' => "Masculino",
                    'email' => "vitorluizfogaca@aspadvocacia.com",
                    'celular' => "(62) 98922-4591",
                    'descricao' => "Paciente 19",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Regina Giovana Ribeiro",
                    'cpf' => "257.022.465-00",
                    'rg' => "44.142.331-0",
                    'data_nasc' => "27/09/2005",
                    'sexo' => "Feminino",
                    'email' => "regina_ribeiro@ulbra.edu.br",
                    'celular' => "(95) 98953-1542",
                    'descricao' => "Paciente 20",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Esther Maitê Nunes",
                    'cpf' => "133.172.197-00",
                    'rg' => "30.453.138-8",
                    'data_nasc' => "02/02/2005",
                    'sexo' => "Feminino",
                    'email' => "esthermaitenunes@amure.com.br",
                    'celular' => "(66) 99552-6150",
                    'descricao' => "Paciente 21",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Carolina Marli da Cruz",
                    'cpf' => "606.797.401-04",
                    'rg' => "24.476.347-1",
                    'data_nasc' => "12/06/2005",
                    'sexo' => "Feminino",
                    'email' => "carolina_marli_dacruz@tita.com.br",
                    'celular' => "(67) 98784-6138",
                    'descricao' => "Paciente 22",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Andreia Mariane Rosângela Lopes",
                    'cpf' => "551.274.565-40",
                    'rg' => "24.119.429-5",
                    'data_nasc' => "27/03/2005",
                    'sexo' => "Feminino",
                    'email' => "andreia-lopes86@dominatto.ind.br",
                    'celular' => "(27) 99321-8232",
                    'descricao' => "Paciente 23",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Esther Joana Lima",
                    'cpf' => "789.673.865-16",
                    'rg' => "20.567.822-1",
                    'data_nasc' => "20/05/2005",
                    'sexo' => "Feminino",
                    'email' => "esther.joana.lima@pib.com.br",
                    'celular' => "(98) 99175-9653",
                    'descricao' => "Paciente 24",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Sebastião Marcelo Rezende",
                    'cpf' => "832.307.604-92",
                    'rg' => "14.968.463-0",
                    'data_nasc' => "26/03/2005",
                    'sexo' => "Masculino",
                    'email' => "sebastiaomarcelorezende@jglima.com.br",
                    'celular' => "(85) 99485-4936",
                    'descricao' => "Paciente 25",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Clarice Tânia Almeida",
                    'cpf' => "636.416.427-79",
                    'rg' => "41.330.391-3",
                    'data_nasc' => "08/05/2005",
                    'sexo' => "Feminino",
                    'email' => "clarice_tania_almeida@yahooo.com.br",
                    'celular' => "(71) 98652-9837",
                    'descricao' => "Paciente 26",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Otávio Márcio Tomás Santos",
                    'cpf' => "598.111.787-71",
                    'rg' => "10.773.796-6",
                    'data_nasc' => "07/05/2005",
                    'sexo' => "Masculino",
                    'email' => "otaviomarciosantos@rubens.adm.br",
                    'celular' => "(96) 98321-2347",
                    'descricao' => "Paciente 27",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Isabella Priscila Priscila Melo",
                    'cpf' => "347.518.110-02",
                    'rg' => "36.154.186-7",
                    'data_nasc' => "08/10/2005",
                    'sexo' => "Feminino",
                    'email' => "isabella_melo@mastria.com.br",
                    'celular' => "(95) 99727-9666",
                    'descricao' => "Paciente 28",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Antônia Lívia Barros",
                    'cpf' => "140.188.378-87",
                    'rg' => "18.012.376-2",
                    'data_nasc' => "18/05/2005",
                    'sexo' => "Feminino",
                    'email' => "antonia-barros79@universo3d.com.br",
                    'celular' => "(83) 99726-7183",
                    'descricao' => "Paciente 29",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'nome' => "Malu Gabriela Cláudia da Silva",
                    'cpf' => "545.490.547-00",
                    'rg' => "35.852.724-7",
                    'data_nasc' => "01/08/2005",
                    'sexo' => "Feminino",
                    'email' => "malu_dasilva@bzness.com.br",
                    'celular' => "(61) 98450-6641",
                    'descricao' => "Paciente 30",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
