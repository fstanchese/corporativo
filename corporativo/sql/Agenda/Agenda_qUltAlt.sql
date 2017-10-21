select
  distinct (Agenda.WPESSOA_ULTALT_ID) as ID,
  upper(wpessoa.usuario) as recognize
from
  Agenda, WPACampus, wpessoa
where
  WPACampus.WPessoa_Id = Agenda.WPESSOA_ULTALT_ID
and
  Agenda.Depart_Id= p_Depart_Id
and
  WPACampus.campus_id = p_CampusAloc_Id
and
  wpessoa.id = Agenda.WPESSOA_ULTALT_ID
order by recognize

