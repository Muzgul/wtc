#ifndef H_LEM_IN
#define H_LEM_IN
#include "libft/libft.h"

typedef struct		s_itreelist
{
	int					id;
	int					x;
	int					y;
	struct s_itreelist	*next;
	struct s_itreelist	**branches;
	int					branches_count;
}					t_itreelist;

int		lem_in(int const fd, char **line);

#endif