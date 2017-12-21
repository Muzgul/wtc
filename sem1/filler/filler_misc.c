#include "filler.h"

int		get_player(void)
{
	char *line;
	char **split;
	char player;

	get_next_line(0, &line);
	while (ft_strncmp(line, "$$$", 3) != 0)
		get_next_line(0, &line);
	split = ft_strsplit(line, ' ');
	player = split[2][1];
	return (player);
}

int		best_edge(char **grid, int context)
{
	int p1_quad;
	int p2_quad;

	p1_quad = quadrant_check(grid, 'o');
	if (p1_quad == -1)
		p1_quad = quadrant_check(grid, 'O');
	p2_quad = quadrant_check(grid, 'x');
	if (p2_quad == -1)
		p2_quad = quadrant_check(grid, 'X');
	if (context == 0)
		return (edge_touch(p1_quad, p2_quad));
	return (edge_touch(p2_quad, p1_quad));
}

int		edge_touch(int q1, int q2)
{
	if ((q1 == 2 && q2 == 1) || (q1 == 3 && q2 == 1))
		return (0);
	if ((q1 == 0 && q2 == 3) || (q1 == 2 && q2 == 3))
		return (1);
	if ((q1 == 1 && q2 == 2) || (q1 == 0 && q2 == 2))
		return (2);
	if ((q1 == 3 && q2 == 0) || (q1 == 1 && q2 == 0))
		return (3);
	return (-1);
}

int		*get_coord(int y, int x)
{
	int *coord;

	coord = (int *)malloc(sizeof(int) * 2);
	coord[0] = y;
	coord[1] = x;
	return (coord);
}

void	print_move(int y, int x)
{
	ft_putnbr(y);
	ft_putchar(' ');
	ft_putnbr(x);
	ft_putchar('\n');
}
