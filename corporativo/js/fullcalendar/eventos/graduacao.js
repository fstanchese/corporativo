 /**
 * CALENDÁRIO ESCOLAR – GRADUAÇÃO 2014
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
				{
                    title: 'Matrícula Veteranos (Todos)',
                    start: '2014-01-02',
					end: '2014-01-04',
					color: 'green'
                },	
				{
                    title: 'Matrícula Veteranos (Todos)',
                    start: '2014-01-06',
					end: '2014-01-07',
					color: 'green'
                },	
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
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-06-19',
					end: '2014-06-21',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-10-15',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-10-28',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dia Não Letivo',
                    start: '2014-11-15',
					color: 'gray'
                },
				{
					id: 101,
                    title: 'Dias Não Letivos',
                    start: '2014-10-20',
					end: '2014-10-22',
					color: 'gray'
                },
				{
					id:201,
                    title: 'Provas Semestrais',
                    start: '2014-06-05',
                    end: '2014-06-07'
                },
				{
					id:201,
                    title: 'Provas Semestrais',
                    start: '2014-06-09',
                    end: '2014-06-14'
                },
				{
					id:201,
                    title: 'Provas Semestrais',
                    start: '2014-06-16',
                    end: '2014-06-18'
                },
				{
					id:201,
                    title: 'Provas Semestrais',
                    start: '2014-06-23',
                    end: '2014-06-28'
                },
				{
					id:201,
                    title: 'Provas Semestrais',
                    start: '2014-06-30'	
                },
				{
					id:202,
                    title: 'Provas Semestrais',
                    start: '2014-11-03',
					end: '2014-11-08'
                },
				{
					id:202,
                    title: 'Provas Semestrais',
                    start: '2014-11-10',
					end: '2014-11-14'
                },
				{
					id:202,
                    title: 'Provas Semestrais',
                    start: '2014-11-17',
					end: '2014-11-22'
                },
				{
					id:202,
                    title: 'Provas Semestrais',
                    start: '2014-11-24'
                },
				{
					id:301,
                    title: 'Requisição para Provas Substitutivas',
                    start: '2014-12-01',
					end: '2014-12-02',
					color: 'purple'
                },
				{
					id:401,
                    title: 'Provas Substitutivas',
                    start: '2014-12-03',
					end: '2014-12-06'
                },
				{
					id:401,
                    title: 'Provas Substitutivas',
                    start: '2014-12-08',
					end: '2014-12-13'
                },
				{
					id:401,
                    title: 'Provas Substitutivas',
                    start: '2014-12-15',
					end: '2014-12-17'
                },
				{
					id:501,
                    title: 'Provas Especiais',
                    start: '2014-07-30',
					end: '2014-07-31',
					color: 'blue'
                },
				{
					id:501,
                    title: 'Provas Especiais',
                    start: '2014-11-27',
					end: '2014-11-28',
					color: 'blue'
                },
				{
					id:501,
                    title: 'Provas Especiais',
                    start: '2014-12-18',
					end: '2014-12-19',
					color: 'blue'
                },
				{
					id:601,
                    title: 'Requisição para Revisão de Notas',
                    start: '2014-08-11',
					end: '2014-08-12',
					color: 'purple'
                },
				{
					id:601,
                    title: 'Requisição para Revisão de Notas',
                    start: '2014-12-02',
					end: '2014-12-03',
					color: 'purple'
                },
				{
					id:601,
                    title: 'Requisição para Revisão de Notas',
                    start: '2014-12-29',
					end: '2014-12-30',
					color: 'purple'
                },
				{
					id:701,
                    title: 'Prazo Entrega de Notas',
                    start: '2014-07-05',
					color: 'green'
                },
				{
					id:701,
                    title: 'Prazo Entrega de Notas',
                    start: '2014-11-29',
					color: 'green'
                },
				{
					id:701,
                    title: 'Prazo Entrega de Notas',
                    start: '2014-12-22',
					color: 'green'
                },
				{
                    title: 'Início das aulas (1º ano)',
                    start: '2014-02-03',
					color: 'red'
                },
				{
                    title: 'Início das aulas (2º ano em diante)',
                    start: '2014-02-04',
					color: 'red'
                },
				{
                    title: 'Início das Aulas do 2º Semestre',
                    start: '2014-08-04',
					color: 'red'
                },
				{
                    title: 'Recesso Escolar',
                    start: '2014-12-26',
                    end: '2015-01-27',
					color: 'gray'
                },
				{
                    title: 'Sem Provas',
                    start: '2014-06-12',
					color: 'gray'
                },
				{
                    title: 'Sem Provas',
                    start: '2014-06-17',
					color: 'gray'
                },
				{
                    title: 'Sem Provas',
                    start: '2014-06-23',
					color: 'gray'
                },
				{
                    title: 'Sem Provas',
                    start: '2014-06-26',
					color: 'gray'
                },
            ]
        });
    });

