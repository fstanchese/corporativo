select
  distinct Agenda.WPessoa_Id as Id,
  upper(Agenda.Us) as recognize
from
  Agenda, WPSXCampus
where
  WPSXCampus.WPessoa_Id = Agenda.WPessoa_Id
and
  Agenda.Depart_Id = p_Depart_Id
and
  WPSXCampus.Campus_Id = $_SESSION[campus_id]
order by recognize

