 /**
 * CALENDÁRIO ESCOLAR – PÓS-GRADUAÇÃO STRICTO SENSU 2014
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
				//Janeiro
				{
                    title: 'Confraternização Universal',
                    start: '2014-01-01',
					color: 'grey'
                },
				{
                    title: 'Feriado',
                    start: '2014-01-25',
					color: 'grey'
                },
				{
                    title: 'Fim do recesso escolar',
                    start: '2014-01-27'
                },
				//Fevereiro
				{
                    title: 'Prazo Final para Exames de Qualificação (alunos pendentes Mestrado Turma 2012)',
                    start: '2014-02-03',
					end: '2014-02-15'
                },
				{
                    title: 'Prazo Final para Depósito da Dissertação (alunos Mestrado Turma 2012)',
                    start: '2014-02-10'
                },
				{
                    title: 'Prazo Final para Exames de Qualificação (alunos pendentes Doutorado Turma 2010)',
                    start: '2014-02-10',
					end: '2014-02-18'
                },
				{
                    title: 'Pedido de Prorrogação de prazo (alunos pendentes Mestrado Turma 2012)',
                    start: '2014-02-11',
					end: '2014-02-13',
					color: 'purple'
                },	
				{
                    title: 'Início das Atividades – Mestrado e Doutorado',
                    start: '2014-02-17',
					color: 'red'
                },	
				{
                    title: 'Pedido de prorrogação de prazo (alunos pendentes Doutorado Turma 2010)',
                    start: '2014-02-19',
					end: '2014-02-21',
					color: 'purple'
                },
				{
                    title: 'Prazo Final para Depósito da Tese (alunos Doutorado Turma 2010)',
                    start: '2014-02-24'
                },
				{
                    title: 'Matrícula em Prorrogação de prazo (alunos pendentes Mestrado Turma 2012 e alunos pendentes Doutorado Turma 2010)',
                    start: '2014-02-26',
					end: '2014-02-28',
					color: 'green'
                },
				{
                    title: 'Solicitação de Alteração de Matrícula',
                    start: '2014-02-17',
					end: '2014-02-18',
					color: 'purple'
                },
				{
                    title: 'Entrevista e Matrícula para Aluno Especial',
                    start: '2014-02-10',
					end: '2014-02-21',
					color: 'green'
                },
				{
                    title: 'Pedido de Convalidação de Créditos',
                    start: '2014-02-24',
					end: '2014-02-28',
					color: 'purple'
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
                    title: 'Prazo Final para Solicitação de Alteração de Matrícula',
                    start: '2014-03-18',
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
				//Maio
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-05-01',
                    end: '2014-05-03',
					color: 'gray'
                },
				{
                    title: 'Pedido de Equivalência Exame de Proficiência',
                    start: '2014-05-05',
					end: '2014-05-09'
                },
				{
                    title: 'Inscrição Exame de Proficiência',
                    start: '2014-05-05',
					end: '2014-05-09',
					color: 'green'
                },
				{
                    title: 'Exame de Proficiência',
                    start: '2014-05-15'
                },
				//Junho
				{
                    title: 'Renovação de Matrícula',
                    start: '2014-06-09',
					end: '2014-06-27',
					color: 'green'
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
                    title: 'Prazo final para entrega das notas (1º sem./2014)',
                    start: '2014-07-05',
					color: 'green'
                },
				{
                    title: 'Férias Escolares',
                    start: '2014-07-01',
					end: '2014-07-31',
					color: 'gray'
				},
				//Agosto
				{
                    title: 'Início das Atividades - Mestrado e Doutorado',
                    start: '2014-08-04',
					color: 'red'
                },
				{
                    title: 'Entrevista e Matrícula para Aluno Especial',
                    start: '2014-08-04',
					end: '2014-08-15',
					color: 'green'
                },
				{
                    title: 'Pedido de Convalidação de Créditos',
                    start: '2014-08-11',
					end: '2014-08-15',
					color: 'purple'
                },
				{
                    title: 'Entrega de Relatório de Estágio de Docência',
                    start: '2014-08-18'
                },
				//Setembro
				{
                    title: 'Prazo Final para a Solicitação de Alteração de Matrícula',
                    start: '2014-09-02'
                },
				//Outubro
				{
                    title: 'Cessão do prédio para as Eleições 2014 (1º turno)',
                    start: '2014-10-04',
					color: 'gray'
				},
				{
                    title: 'Pedido de Equivalência Exame de Proficiência',
                    start: '2014-10-01',
					end: '2014-10-08'
                },
				{
                    title: 'Inscrição Exame de Proficiência',
                    start: '2014-10-01',
					end: '2014-10-08',
					color: 'green'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-10-15',
					color: 'gray'
                },
				{
                    title: 'Exame de Proficiência',
                    start: '2014-10-16'
                },
				{
                    title: 'Cessão do prédio para as Eleições 2014 (2º turno)',
                    start: '2014-10-25',
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
				{
                    title: 'Prazo Final para a realização de Bancas de Qualificação em 2014 (Mestrado/Doutorado)',
                    start: '2014-11-28'
                },
				//Dezembro
				{
                    title: 'Renovação de Matrícula',
                    start: '2014-12-08',
					end: '2014-12-19',
					color: 'green'
                },
				{
                    title: 'Prazo Final para a realização das Bancas de Defesa em 2014 (Mestrado/Doutorado)',
                    start: '2014-12-12'
				},
				{
                    title: 'Matrícula Inicial Aluno Regular (ingressantes)',
                    start: '2014-12-15',
					end: '2014-12-19',
					color: 'green'
                },
				{
                    title: 'Entrega de Relatório de Estágio de Docência',
                    start: '2014-12-18'
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
                }
            ]
        });
    });
