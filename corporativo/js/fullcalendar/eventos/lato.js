 /**
 * CALENDÁRIO ESCOLAR – PÓS-GRADUAÇÃO LATO SENSU 2014
 **/
 $(document).on('pageshow','#index',function(e,data){   
 
		$('#calendar').fullCalendar({
			
			eventClick: function(calEvent, jsEvent, view) {
					alert(calEvent.title);
				},		
			
			buttonText: {
					prev: "&nbsp;&nbsp;&#8672;",
					next: "&nbsp;&nbsp;&#8674;"
				},	
            events: [
				//Fevereiro
				{
                    title: 'Prazo final para entrega das notas (4º módulo de 2013)',
                    start: '2014-02-15',
					color: 'green'
                },	
				{
                    title: 'Solicitação de revisão de nota',
                    start: '2014-02-15',
					end: '2014-02-22',
					color: 'purple'
                },	
				{
                    title: 'Início das aulas para as turmas de sábado',
                    start: '2014-02-22',
					color: 'red'
                },	
				{
                    title: 'Início das aulas para as turmas de 2ª/4ª',
                    start: '2014-02-24',
					color: 'red'
                },	
				{
                    title: 'Início das aulas para as turmas de 3ª/5ª',
                    start: '2014-02-25',
					color: 'red'
                },
				{
                    title: 'Matrícula em Orientação de Monografia (turmas 121 e anteriores)',
                    start: '2014-02-17',
					end: '2014-02-22'
                },
				//Março					
                {
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-03-01',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-03-03',
                    end: '2014-03-05',
					color: 'gray'
                },
				{
                    title: 'Prazo final matrícula de ingressantes/análise de retorno no 1º módulo 2014)',
                    start: '2014-03-08',
					color: 'green'
                },
				//Abril
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-04-17',
                    end: '2014-04-19',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-04-21',
					color: 'gray'
                },
				{
                    title: 'Início do 2º módulo 2014',
                    start: '2014-04-26',
					color: 'red'
                },
				{
                    title: 'Prazo final para matrícula de ingressantes/análise de retorno',
                    start: '2014-04-26',
					color: 'green'
                },
				//Maio
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-05-01',
                    end: '2014-05-03',
					color: 'gray'
                },
				{
                    title: 'Prazo final para entrega das notas (1º módulo 2014)',
                    start: '2014-05-10',
					color: 'green'
                },
				//Junho
				{
                    title: 'Período final para entrega da monografia (Turma 122 e matriculados, 1º sem./2014, em Orientação de Monografia)',
                    start: '2014-06-02',
					end: '2014-06-14'
                },
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-06-19',
					end: '2014-06-21',
					color: 'gray'
                },
				{
                    title: 'Término do semestre',
                    start: '2014-06-30'
				},
				//Julho
				{
                    title: 'Férias Escolares',
                    start: '2014-07-01',
					end: '2014-07-31',
					color: 'gray'
				},
				//Agosto
				{
                    title: 'Prazo final para entrega das notas (2º módulo 2014)',
                    start: '2014-08-02',
					color: 'green'
                },
				{
                    title: 'Matrícula em Orientação de Monografia (turma 122 e anteriores)',
                    start: '2014-08-02',
					end: '2014-08-09'
                },
				{
                    title: 'Solicitação de revisão de nota',
                    start: '2014-08-02',
					end: '2014-08-09',
					color: 'purple'
                },
				{
                    title: 'Início das aulas para as turmas de sábado',
                    start: '2014-08-09',
					color: 'red'
                },	
				{
                    title: 'Início das aulas para as turmas de 2ª/4ª',
                    start: '2014-08-11',
					color: 'red'
                },	
				{
                    title: 'Início das aulas para as turmas de 3ª/5ª',
                    start: '2014-08-12',
					color: 'red'
                },
				{
                    title: 'Prazo final matrícula de ingressantes/análise de retorno no 3º módulo 2014',
                    start: '2014-08-16',
					color: 'green'
                },
				//Setembro
				{
                    title: 'Início do 4º módulo 2014',
                    start: '2014-09-27',
					color: 'red'
                },
				{
                    title: 'Prazo final para matrícula de ingressantes/análise de retorno',
                    start: '2014-09-27',
					color: 'green'
                },
				//Outubro
				{
                    title: 'Cessão do prédio para as Eleições 2014 (1º turno)',
                    start: '2014-10-04',
					end: '2014-10-05',
					color: 'gray'
				},
				{
                    title: 'Prazo final para entrega das notas (3º módulo 2014)',
                    start: '2014-10-11',
					color: 'green'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-10-15',
					color: 'gray'
                },
				{
                    title: 'Cessão do prédio para as Eleições 2014 (2º turno)',
                    start: '2014-10-25',
					end: '2014-10-26',
					color: 'gray'
				},
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-10-28',
					color: 'gray'
                },
				//Novembro
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-11-15',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-11-20',
					end: '2014-11-22',
					color: 'gray'
                },
				//Dezembro
				{
                    title: 'Período final para entrega da monografia (Turma 131 e matriculados, 2º sem./2014, em Orientação de Monografia)',
                    start: '2014-12-01',
					end: '2014-12-13'
                },
				{
                    title: 'Término do semestre',
                    start: '2014-12-20'
				},
				{
                    title: 'Recesso Escolar',
                    start: '2014-12-26',
                    end: '2015-01-27',
					color: 'gray'
                },
				//Janeiro
				{
                    title: 'Prazo final para entrega das notas (4º módulo 2014)',
                    start: '2015-02-14',
					color: 'green'
				}
            ]
        });
    });
