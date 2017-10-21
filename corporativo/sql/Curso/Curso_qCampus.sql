select   
	Curso.Id   as id,
	Curso.Nome as Recognize
from 
	Curso,
	CurrOfe,
	TurmaOfe, 
	Curr
where
	TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
	Curr.Curso_Id = Curso.Id
and
	CurrOfe.Curr_Id = Curr.Id
and
	(
	p_Periodo_Id is null
	or
	CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0)
	) 
and
	(
    p_PLetivo_Id is null
      or
    CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0)
	)
and
	(
    p_Campus_Id is null
      or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
	)
and
	(
    p_CursoNivel_Id is null 
      or 
    CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
	)
and
	(
    p_Facul_Id is null
      or
    Curso.Facul_Id = nvl( p_Facul_Id , 0)
	)
and
	InstEns_Id = 8900000000001
group by Curso.id, Curso.Nome
union
select   
	Curso.Id   as id,
	Curso.Nome as Recognize
from
	curso
where
	( p_CursoNivel_Id is null or p_CursoNivel_Id = 6200000000001 )
and  
	Curso.Id = 5700000000069 
order by Recognize